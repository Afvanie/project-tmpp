<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view(
            'admin.news.index',
            [
                'news' => $news,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'admin.news.create'
        );
    }

    public function store(
        Request $request
    ): RedirectResponse {
        $validated = $request->validate(
            $this->validationRules()
        );

        $imagePath = null;

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request
                    ->file('image')
                    ->store(
                        'news',
                        'public'
                    );
            }

            $slug = $this->generateUniqueSlug(
                $validated['title']
            );

            $isActive = $request->boolean(
                'is_active'
            );

            $publishedAt =
                $validated['published_at']
                ?? null;

            if (
                $isActive
                && empty($publishedAt)
            ) {
                $publishedAt = now();
            }

            News::query()->create([
                'title' =>
                    trim(
                        $validated['title']
                    ),

                'slug' =>
                    $slug,

                'image' =>
                    $imagePath,

                'excerpt' =>
                    $this->nullableTrim(
                        $validated['excerpt']
                        ?? null
                    ),

                'content' =>
                    trim(
                        $validated['content']
                    ),

                'published_at' =>
                    $publishedAt,

                'is_active' =>
                    $isActive,
            ]);
        } catch (Throwable $exception) {
            if (
                $imagePath !== null
                && Storage::disk('public')
                    ->exists($imagePath)
            ) {
                Storage::disk('public')
                    ->delete($imagePath);
            }

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Berita belum dapat disimpan. Silakan coba kembali.'
                );
        }

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'Berita berhasil ditambahkan.'
            );
    }

    public function edit(
        News $news
    ): View {
        return view(
            'admin.news.edit',
            [
                'news' => $news,
            ]
        );
    }

    public function update(
        Request $request,
        News $news
    ): RedirectResponse {
        $validated = $request->validate(
            $this->validationRules(
                $news
            )
        );

        $oldImage = $news->image;
        $newImage = null;

        try {
            if ($request->hasFile('image')) {
                $newImage = $request
                    ->file('image')
                    ->store(
                        'news',
                        'public'
                    );
            }

            $isActive = $request->boolean(
                'is_active'
            );

            $publishedAt =
                $validated['published_at']
                ?? $news->published_at;

            if (
                $isActive
                && empty($publishedAt)
            ) {
                $publishedAt = now();
            }

            $news->update([
                'title' =>
                    trim(
                        $validated['title']
                    ),

                'slug' =>
                    $this->generateUniqueSlug(
                        $validated['title'],
                        $news
                    ),

                'image' =>
                    $newImage
                    ?? $oldImage,

                'excerpt' =>
                    $this->nullableTrim(
                        $validated['excerpt']
                        ?? null
                    ),

                'content' =>
                    trim(
                        $validated['content']
                    ),

                'published_at' =>
                    $publishedAt,

                'is_active' =>
                    $isActive,
            ]);
        } catch (Throwable $exception) {
            if (
                $newImage !== null
                && Storage::disk('public')
                    ->exists($newImage)
            ) {
                Storage::disk('public')
                    ->delete($newImage);
            }

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Berita belum dapat diperbarui. Silakan coba kembali.'
                );
        }

        if (
            $newImage !== null
            && $oldImage !== null
            && $oldImage !== $newImage
            && Storage::disk('public')
                ->exists($oldImage)
        ) {
            Storage::disk('public')
                ->delete($oldImage);
        }

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );
    }

    public function destroy(
        News $news
    ): RedirectResponse {
        $imagePath = $news->image;

        try {
            $news->delete();
        } catch (Throwable $exception) {
            report($exception);

            return back()->with(
                'error',
                'Berita belum dapat dihapus.'
            );
        }

        if (
            $imagePath !== null
            && Storage::disk('public')
                ->exists($imagePath)
        ) {
            Storage::disk('public')
                ->delete($imagePath);
        }

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'Berita berhasil dihapus.'
            );
    }

    private function validationRules(
        ?News $news = null
    ): array {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'excerpt' => [
                'nullable',
                'string',
                'max:500',
            ],

            'content' => [
                'required',
                'string',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    private function generateUniqueSlug(
        string $title,
        ?News $currentNews = null
    ): string {
        $baseSlug = Str::slug(
            $title
        );

        if ($baseSlug === '') {
            $baseSlug = 'berita';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            News::query()
                ->where(
                    'slug',
                    $slug
                )
                ->when(
                    $currentNews !== null,
                    function ($query) use (
                        $currentNews
                    ) {
                        $query->where(
                            'id',
                            '!=',
                            $currentNews->id
                        );
                    }
                )
                ->exists()
        ) {
            $slug =
                $baseSlug
                . '-'
                . $counter;

            $counter++;
        }

        return $slug;
    }

    private function nullableTrim(
        mixed $value
    ): ?string {
        if ($value === null) {
            return null;
        }

        $value = trim(
            (string) $value
        );

        return $value !== ''
            ? $value
            : null;
    }
}