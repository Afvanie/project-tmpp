<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\HomeStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function index()
    {
        $homeContent = HomeContent::firstOrCreate(
            ['section_key' => 'program_description'],
            [
                'badge' => 'Program Studi',
                'title' => 'Deskripsi Program Studi',
                'description' => 'Program Studi D-IV Teknik Mesin Produksi dan Perawatan merupakan program pendidikan vokasi di Jurusan Teknik Mesin Politeknik Negeri Malang yang mempersiapkan lulusan Sarjana Terapan dengan kompetensi dalam bidang produksi, manufaktur, dan perawatan mesin.',
                'button_text' => 'Selengkapnya',
                'button_url' => '/profile',
                'is_active' => true,
            ]
        );

        $content = $homeContent;

        $statistics = HomeStatistic::orderBy('sort_order')->get();

        return view('admin.home-content.index', compact(
            'homeContent',
            'content',
            'statistics'
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'statistics' => 'nullable|array',
            'statistics.*.label' => 'required|string|max:255',
            'statistics.*.value' => 'required|string|max:255',
            'statistics.*.sort_order' => 'nullable|integer|min:0',
        ]);

        $homeContent = HomeContent::firstOrCreate(
            ['section_key' => 'program_description']
        );

        $data = [
            'badge' => $validated['badge'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'button_text' => $validated['button_text'] ?? null,
            'button_url' => $validated['button_url'] ?? null,
            'is_active' => true,
        ];

        if ($request->hasFile('image')) {
            if ($homeContent->image && Storage::disk('public')->exists($homeContent->image)) {
                Storage::disk('public')->delete($homeContent->image);
            }

            $data['image'] = $request->file('image')->store('home-content', 'public');
        }

        $homeContent->update($data);

        if ($request->has('statistics')) {
            foreach ($request->statistics as $id => $statistic) {
                HomeStatistic::where('id', $id)->update([
                    'label' => $statistic['label'],
                    'value' => $statistic['value'],
                    'sort_order' => $statistic['sort_order'] ?? 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.home-content.index')
            ->with('success', 'Konten beranda berhasil diperbarui.');
    }
}