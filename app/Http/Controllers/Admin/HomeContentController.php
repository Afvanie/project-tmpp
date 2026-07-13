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
        $content = HomeContent::firstOrCreate(
            ['section_key' => 'program_description'],
            [
                'badge' => 'Program Studi',
                'title' => 'Deskripsi Program Studi',
                'description' => '',
                'button_text' => 'Selengkapnya',
                'button_url' => '/profile',
                'is_active' => true,
            ]
        );

        $statistics = HomeStatistic::orderBy('sort_order')->get();

        return view('admin.home-content.index', compact('content', 'statistics'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            'statistics' => 'nullable|array',
            'statistics.*.value' => 'required|string|max:255',
            'statistics.*.label' => 'required|string|max:255',
            'statistics.*.sort_order' => 'nullable|integer',
        ]);

        $content = HomeContent::where('section_key', 'program_description')->firstOrFail();

        $data = $request->only([
            'badge',
            'title',
            'description',
            'button_text',
            'button_url',
        ]);

        if ($request->hasFile('image')) {
            if ($content->image && Storage::disk('public')->exists($content->image)) {
                Storage::disk('public')->delete($content->image);
            }

            $data['image'] = $request->file('image')->store('home', 'public');
        }

        $content->update($data);

        if ($request->has('statistics')) {
            foreach ($request->statistics as $id => $statisticData) {
                HomeStatistic::where('id', $id)->update([
                    'value' => $statisticData['value'],
                    'label' => $statisticData['label'],
                    'sort_order' => $statisticData['sort_order'] ?? 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.home-content.index')
            ->with('success', 'Konten beranda berhasil diperbarui.');
    }
}