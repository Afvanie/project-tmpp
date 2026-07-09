<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->get();

        return view('admin.admin-users.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin-users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', 'Admin pengelola berhasil ditambahkan.');
    }

    public function edit(Admin $adminUser)
    {
        return view('admin.admin-users.edit', compact('adminUser'));
    }

    public function update(Request $request, Admin $adminUser)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($adminUser->id),
            ],

            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $adminUser->update($data);

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', 'Data admin pengelola berhasil diperbarui.');
    }

    public function destroy(Admin $adminUser)
    {
        if (auth('admin')->id() === $adminUser->id) {
            return redirect()
                ->route('admin.admin-users.index')
                ->with('error', 'Admin yang sedang login tidak dapat menghapus akunnya sendiri.');
        }

        if (Admin::count() <= 1) {
            return redirect()
                ->route('admin.admin-users.index')
                ->with('error', 'Minimal harus ada satu akun admin.');
        }

        $adminUser->delete();

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', 'Admin pengelola berhasil dihapus.');
    }
}