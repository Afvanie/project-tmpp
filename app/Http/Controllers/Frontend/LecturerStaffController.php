<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LecturerStaff;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LecturerStaffController extends Controller
{
    /**
     * Menampilkan daftar dosen dan staf Program Studi D-IV TMPP.
     */
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | PARAMETER PENCARIAN
        |--------------------------------------------------------------------------
        */

        $search = trim(
            (string) $request->query('search', '')
        );

        /*
        | Membatasi panjang kata kunci agar query tetap wajar.
        */

        $search = mb_substr($search, 0, 100);


        /*
        |--------------------------------------------------------------------------
        | FILTER JENIS
        |--------------------------------------------------------------------------
        */

        $type = strtolower(
            trim(
                (string) $request->query('type', 'all')
            )
        );

        $allowedTypes = [
            'all',
            'dosen',
            'staff',
        ];

        if (!in_array($type, $allowedTypes, true)) {
            $type = 'all';
        }


        /*
        |--------------------------------------------------------------------------
        | QUERY DOSEN DAN STAF
        |--------------------------------------------------------------------------
        */

        $query = LecturerStaff::query();

        if ($search !== '') {
            $query->where(
                function (Builder $query) use ($search): void {
                    $query
                        ->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'nip',
                            'like',
                            '%' . $search . '%'
                        );
                }
            );
        }

        if (in_array($type, ['dosen', 'staff'], true)) {
            $query->where('type', $type);
        }


        /*
        |--------------------------------------------------------------------------
        | URUTAN DAN PAGINATION
        |--------------------------------------------------------------------------
        |
        | Dosen ditampilkan lebih dahulu, kemudian staf.
        | CASE digunakan agar tidak bergantung pada fungsi FIELD milik MySQL.
        |
        */

        $lecturerStaff = $query
            ->orderByRaw(
                "
                CASE
                    WHEN type = 'dosen' THEN 1
                    WHEN type = 'staff' THEN 2
                    ELSE 3
                END
                "
            )
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        |
        | Statistik menampilkan jumlah seluruh data, bukan hanya hasil
        | pencarian atau filter yang sedang digunakan.
        |
        */

        $totalAll = LecturerStaff::query()->count();

        $totalDosen = LecturerStaff::query()
            ->where('type', 'dosen')
            ->count();

        $totalStaff = LecturerStaff::query()
            ->where('type', 'staff')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('frontend.lecturers', [
            'lecturerStaff' => $lecturerStaff,
            'search' => $search,
            'type' => $type,
            'totalAll' => $totalAll,
            'totalDosen' => $totalDosen,
            'totalStaff' => $totalStaff,
        ]);
    }
}