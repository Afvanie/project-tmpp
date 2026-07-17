<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileItem;
use App\Models\ProfileSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileContentController extends Controller
{
    public function index(): View
    {
        $sections = ProfileSection::query()
            ->withCount('items')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'admin.profile-contents.index',
            compact('sections')
        );
    }

    public function edit(
        ProfileSection $profileSection
    ): View {
        $profileSection->load([
            'items' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);

        return view(
            'admin.profile-contents.edit',
            compact('profileSection')
        );
    }

    public function update(
        Request $request,
        ProfileSection $profileSection
    ): RedirectResponse {
        $allowedGroups = $this->allowedBatchGroups(
            $profileSection
        );

        $validated = $request->validate(
            [
                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'subtitle' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'is_active' => [
                    'nullable',
                    'boolean',
                ],

                'main_content' => [
                    'nullable',
                    'string',
                ],

                'overview_label' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'overview_image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:4096',
                ],

                'remove_overview_image' => [
                    'nullable',
                    'boolean',
                ],

                'vision_content' => [
                    'nullable',
                    'string',
                ],

                'items' => [
                    'nullable',
                    'array',
                ],

                'items.*.id' => [
                    'nullable',
                    'integer',
                    'exists:profile_items,id',
                ],

                'items.*.item_group' => [
                    'required_with:items',
                    'string',
                    Rule::in($allowedGroups),
                ],

                'items.*.title' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'items.*.content' => [
                    'nullable',
                    'string',
                ],

                'items.*.value' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'items.*.note' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'items.*.sort_order' => [
                    'nullable',
                    'integer',
                    'min:0',
                ],

                'items.*.is_active' => [
                    'nullable',
                    'boolean',
                ],

                'items.*.delete' => [
                    'nullable',
                    'boolean',
                ],
            ],
            [
                'title.required' =>
                    'Judul bagian harus diisi.',

                'title.max' =>
                    'Judul bagian maksimal 255 karakter.',

                'subtitle.max' =>
                    'Teks kecil di atas judul maksimal 255 karakter.',

                'overview_label.max' =>
                    'Teks kecil di atas isi profil maksimal 255 karakter.',

                'overview_image.image' =>
                    'File yang dipilih tidak dapat dibaca sebagai foto.',

                'overview_image.mimes' =>
                    'Foto harus berformat JPG, JPEG, PNG, atau WebP.',

                'overview_image.max' =>
                    'Ukuran foto maksimal 4 MB.',

                'items.*.item_group.in' =>
                    'Jenis isi tidak sesuai dengan bagian yang dikelola.',

                'items.*.title.max' =>
                    'Judul atau nomor maksimal 255 karakter.',

                'items.*.value.max' =>
                    'Nilai informasi maksimal 255 karakter.',

                'items.*.note.max' =>
                    'Keterangan informasi maksimal 255 karakter.',

                'items.*.sort_order.integer' =>
                    'Urutan harus berupa angka.',

                'items.*.sort_order.min' =>
                    'Urutan tidak boleh kurang dari 0.',
            ]
        );

        DB::transaction(function () use (
            $request,
            $validated,
            $profileSection
        ): void {
            /*
            |--------------------------------------------------------------------------
            | INFORMASI BAGIAN
            |--------------------------------------------------------------------------
            */

            $profileSection->update([
                'title' => $validated['title'],
                'subtitle' =>
                    $validated['subtitle'] ?? null,
                'description' =>
                    $validated['description'] ?? null,
                'is_active' =>
                    $request->boolean('is_active'),
            ]);


            /*
            |--------------------------------------------------------------------------
            | NARASI GAMBARAN UMUM DAN SEJARAH
            |--------------------------------------------------------------------------
            */

            if (
                in_array(
                    $profileSection->slug,
                    ['overview', 'history'],
                    true
                )
            ) {
                $this->syncSingleItem(
                    section: $profileSection,
                    aliases: ['paragraph'],
                    canonicalGroup: 'paragraph',
                    content: trim(
                        (string) (
                            $validated['main_content']
                            ?? ''
                        )
                    ),
                    title: null
                );
            }


            /*
            |--------------------------------------------------------------------------
            | LABEL GAMBARAN UMUM
            |--------------------------------------------------------------------------
            */

            if ($profileSection->slug === 'overview') {
                $this->syncSingleItem(
                    section: $profileSection,
                    aliases: ['label'],
                    canonicalGroup: 'label',
                    content: trim(
                        (string) (
                            $validated['overview_label']
                            ?? ''
                        )
                    ),
                    title: 'Label Konten'
                );

                $this->syncOverviewImage(
                    request: $request,
                    section: $profileSection
                );
            }


            /*
            |--------------------------------------------------------------------------
            | VISI
            |--------------------------------------------------------------------------
            */

            if (
                $profileSection->slug
                === 'visi-misi'
            ) {
                $this->syncSingleItem(
                    section: $profileSection,
                    aliases: ['visi', 'vision'],
                    canonicalGroup: 'visi',
                    content: trim(
                        (string) (
                            $validated['vision_content']
                            ?? ''
                        )
                    ),
                    title: 'Visi Program Studi'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | SEMUA ITEM DAFTAR
            |--------------------------------------------------------------------------
            */

            $this->syncBatchItems(
                section: $profileSection,
                rows: $validated['items'] ?? []
            );
        });

        return redirect()
            ->route(
                'admin.profile-contents.edit',
                $profileSection
            )
            ->with(
                'success',
                'Semua perubahan '
                . $this->sectionName(
                    $profileSection
                )
                . ' berhasil disimpan.'
            );
    }

    public function storeItem(
        Request $request,
        ProfileSection $profileSection
    ): RedirectResponse {
        return redirect()
            ->route(
                'admin.profile-contents.edit',
                $profileSection
            )
            ->with(
                'success',
                'Gunakan tombol Simpan Semua Perubahan untuk menyimpan data.'
            );
    }

    public function updateItem(
        Request $request,
        ProfileItem $profileItem
    ): RedirectResponse {
        $section = $profileItem->section;

        abort_unless($section, 404);

        return redirect()
            ->route(
                'admin.profile-contents.edit',
                $section
            )
            ->with(
                'success',
                'Gunakan tombol Simpan Semua Perubahan untuk menyimpan data.'
            );
    }

    public function destroyItem(
        ProfileItem $profileItem
    ): RedirectResponse {
        $section = $profileItem->section;

        abort_unless($section, 404);

        $profileItem->delete();

        return redirect()
            ->route(
                'admin.profile-contents.edit',
                $section
            )
            ->with(
                'success',
                'Isi berhasil dihapus.'
            );
    }

    private function syncBatchItems(
        ProfileSection $section,
        array $rows
    ): void {
        foreach ($rows as $row) {
            $id = isset($row['id'])
                ? (int) $row['id']
                : null;

            $existingItem = $id
                ? $section
                    ->items()
                    ->whereKey($id)
                    ->first()
                : null;

            if (
                (bool) ($row['delete'] ?? false)
            ) {
                $existingItem?->delete();

                continue;
            }

            $group = trim(
                (string) (
                    $row['item_group']
                    ?? ''
                )
            );

            $title = trim(
                (string) (
                    $row['title']
                    ?? ''
                )
            );

            $content = $group === 'info_card'
                ? $this->buildInfoCardContent(
                    $row
                )
                : trim(
                    (string) (
                        $row['content']
                        ?? ''
                    )
                );

            $isCompletelyEmpty = $title === ''
                && $content === '';

            if (
                !$existingItem
                && $isCompletelyEmpty
            ) {
                continue;
            }

            $data = [
                'item_group' => $group,
                'title' =>
                    $title !== ''
                        ? $title
                        : null,
                'content' => $content,
                'sort_order' => (int) (
                    $row['sort_order']
                    ?? 0
                ),
                'is_active' => (bool) (
                    $row['is_active']
                    ?? false
                ),
            ];

            if ($existingItem) {
                $existingItem->update($data);

                continue;
            }

            $section->items()->create($data);
        }
    }

    private function buildInfoCardContent(
        array $row
    ): string {
        $value = trim(
            (string) (
                $row['value']
                ?? ''
            )
        );

        $note = trim(
            (string) (
                $row['note']
                ?? ''
            )
        );

        return $value . '|' . $note;
    }

    private function syncSingleItem(
        ProfileSection $section,
        array $aliases,
        string $canonicalGroup,
        string $content,
        ?string $title
    ): void {
        $items = $section
            ->items()
            ->whereIn(
                'item_group',
                $aliases
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        if ($content === '') {
            $section
                ->items()
                ->whereIn(
                    'item_group',
                    $aliases
                )
                ->delete();

            return;
        }

        $primaryItem = $items->first();

        if ($primaryItem) {
            $primaryItem->update([
                'item_group' =>
                    $canonicalGroup,
                'title' => $title,
                'content' => $content,
                'sort_order' => 1,
                'is_active' => true,
            ]);

            $items
                ->skip(1)
                ->each
                ->delete();

            return;
        }

        $section->items()->create([
            'item_group' =>
                $canonicalGroup,
            'title' => $title,
            'content' => $content,
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }

    private function syncOverviewImage(
        Request $request,
        ProfileSection $section
    ): void {
        $imageItems = $section
            ->items()
            ->where('item_group', 'image')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $currentImageItem =
            $imageItems->first();

        $currentPath = trim(
            (string) (
                $currentImageItem?->content
                ?? ''
            )
        );

        if ($request->hasFile('overview_image')) {
            $newPath = $request
                ->file('overview_image')
                ->store(
                    'profile-content/overview',
                    'public'
                );

            $this->deletePublicFile(
                $currentPath
            );

            if ($currentImageItem) {
                $currentImageItem->update([
                    'title' =>
                        'Foto Gambaran Umum',
                    'content' => $newPath,
                    'sort_order' => 1,
                    'is_active' => true,
                ]);
            } else {
                $section->items()->create([
                    'item_group' => 'image',
                    'title' =>
                        'Foto Gambaran Umum',
                    'content' => $newPath,
                    'sort_order' => 1,
                    'is_active' => true,
                ]);
            }

            $imageItems
                ->skip(1)
                ->each(function (
                    ProfileItem $item
                ): void {
                    $this->deletePublicFile(
                        $item->content
                    );

                    $item->delete();
                });

            return;
        }

        if (
            $request->boolean(
                'remove_overview_image'
            )
        ) {
            $imageItems->each(function (
                ProfileItem $item
            ): void {
                $this->deletePublicFile(
                    $item->content
                );

                $item->delete();
            });
        }
    }

    private function deletePublicFile(
        ?string $path
    ): void {
        $path = trim((string) $path);

        if ($path === '') {
            return;
        }

        if (
            Storage::disk('public')
                ->exists($path)
        ) {
            Storage::disk('public')
                ->delete($path);
        }
    }

    private function allowedBatchGroups(
        ProfileSection $section
    ): array {
        return match ($section->slug) {
            'overview' => [
                'info_card',
            ],

            'history' => [
                'timeline',
            ],

            'visi-misi' => [
                'misi',
            ],

            'tujuan-prodi' => [
                'tujuan',
            ],

            'ppm' => [
                'ppm',
            ],

            'cpl' => [
                'cpl',
            ],

            default => [
                'content',
            ],
        };
    }

    private function sectionName(
        ProfileSection $section
    ): string {
        return match ($section->slug) {
            'overview' =>
                'Gambaran Umum Program Studi',

            'history' =>
                'Sejarah Program Studi',

            'visi-misi' =>
                'Visi dan Misi',

            'tujuan-prodi' =>
                'Tujuan Program Studi',

            'ppm' =>
                'Profil Profesional Mandiri',

            'cpl' =>
                'Capaian Pembelajaran Lulusan',

            default =>
                $section->title,
        };
    }
}
