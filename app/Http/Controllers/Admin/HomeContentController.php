<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\HomeStatistic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeContentController extends Controller
{
    public function index(): View
    {
        $homeContent = HomeContent::query()->firstOrCreate(
            [
                'section_key' => 'program_description',
            ],
            [
                'badge' => 'Program Studi',
                'title' => 'Deskripsi Program Studi',
                'description' =>
                    'Program Studi D-IV Teknik Mesin Produksi dan '
                    . 'Perawatan merupakan program pendidikan vokasi '
                    . 'di Jurusan Teknik Mesin Politeknik Negeri Malang '
                    . 'yang mempersiapkan lulusan Sarjana Terapan '
                    . 'dengan kompetensi dalam bidang produksi, '
                    . 'manufaktur, dan perawatan mesin.',
                'button_text' => 'Selengkapnya',
                'button_url' => '/profile',
                'is_active' => true,
            ]
        );

        $content = $homeContent;

        $statistics = HomeStatistic::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'admin.home-content.index',
            compact(
                'homeContent',
                'content',
                'statistics'
            )
        );
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'badge' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'required',
                    'string',
                ],

                'button_text' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'button_url' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:4096',
                ],

                'hero_video' => [
                    'nullable',
                    'file',
                    'mimes:mp4,webm',
                    'max:51200',
                ],

                'remove_hero_video' => [
                    'nullable',
                    'boolean',
                ],

                'statistics' => [
                    'nullable',
                    'array',
                ],

                'statistics.*.label' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'statistics.*.value' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'statistics.*.sort_order' => [
                    'nullable',
                    'integer',
                    'min:0',
                ],
            ],
            [
                'hero_video.mimes' =>
                    'Video hero harus berformat MP4 atau WebM.',

                'hero_video.max' =>
                    'Ukuran video hero maksimal 50 MB.',

                'image.max' =>
                    'Ukuran gambar maksimal 4 MB.',
            ]
        );

        $homeContent = HomeContent::query()->firstOrCreate(
            [
                'section_key' => 'program_description',
            ]
        );

        $data = [
            'badge' => $validated['badge'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'button_text' => $validated['button_text'] ?? null,
            'button_url' => $validated['button_url'] ?? null,
            'is_active' => true,
        ];

        /*
        |--------------------------------------------------------------------------
        | GAMBAR DESKRIPSI
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $newImagePath = $request
                ->file('image')
                ->store(
                    'home-content/images',
                    'public'
                );

            $this->deletePublicFile(
                $homeContent->image
            );

            $data['image'] = $newImagePath;
        }

        /*
        |--------------------------------------------------------------------------
        | VIDEO HERO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('hero_video')) {
            $newVideoPath = $request
                ->file('hero_video')
                ->store(
                    'home-content/videos',
                    'public'
                );

            $this->deletePublicFile(
                $homeContent->hero_video
            );

            $data['hero_video'] = $newVideoPath;
        } elseif (
            $request->boolean('remove_hero_video')
        ) {
            $this->deletePublicFile(
                $homeContent->hero_video
            );

            $data['hero_video'] = null;
        }

        $homeContent->update($data);

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        foreach (
            $validated['statistics'] ?? []
            as $id => $statistic
        ) {
            HomeStatistic::query()
                ->whereKey($id)
                ->update([
                    'label' => $statistic['label'],
                    'value' => $statistic['value'],
                    'sort_order' =>
                        $statistic['sort_order'] ?? 0,
                ]);
        }

        return redirect()
            ->route('admin.home-content.index')
            ->with(
                'success',
                'Konten beranda berhasil diperbarui.'
            );
    }

    private function deletePublicFile(
        ?string $path
    ): void {
        $path = trim((string) $path);

        if ($path === '') {
            return;
        }

        if (
            Storage::disk('public')->exists($path)
        ) {
            Storage::disk('public')->delete($path);
        }
    }
}