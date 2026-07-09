<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileItem;
use App\Models\ProfileSection;
use Illuminate\Http\Request;

class ProfileContentController extends Controller
{
    public function index()
    {
        $sections = ProfileSection::withCount('items')
            ->orderBy('sort_order')
            ->get();

        return view('admin.profile-contents.index', compact('sections'));
    }

    public function edit(ProfileSection $profileSection)
    {
        $profileSection->load([
            'items' => function ($query) {
                $query->orderBy('sort_order');
            }
        ]);

        return view('admin.profile-contents.edit', compact('profileSection'));
    }

    public function update(Request $request, ProfileSection $profileSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $profileSection->update($validated);

        return redirect()
            ->route('admin.profile-contents.edit', $profileSection)
            ->with('success', 'Section berhasil diperbarui.');
    }

    public function storeItem(Request $request, ProfileSection $profileSection)
    {
        $validated = $request->validate([
            'item_group' => 'nullable|string|max:100',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $profileSection->items()->create($validated);

        return redirect()
            ->route('admin.profile-contents.edit', $profileSection)
            ->with('success', 'Item konten berhasil ditambahkan.');
    }

    public function updateItem(Request $request, ProfileItem $profileItem)
    {
        $validated = $request->validate([
            'item_group' => 'nullable|string|max:100',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $profileItem->update($validated);

        return redirect()
            ->route('admin.profile-contents.edit', $profileItem->section)
            ->with('success', 'Item konten berhasil diperbarui.');
    }

    public function destroyItem(ProfileItem $profileItem)
    {
        $section = $profileItem->section;

        $profileItem->delete();

        return redirect()
            ->route('admin.profile-contents.edit', $section)
            ->with('success', 'Item konten berhasil dihapus.');
    }
}