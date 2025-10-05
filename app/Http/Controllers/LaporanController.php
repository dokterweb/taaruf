<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Member_paket;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function penjualan(Request $request)
    {
        // Ambil inputan atau default
        $start = $request->input('start_date') ?? Carbon::now()->startOfMonth()->toDateString();
        $end = $request->input('end_date') ?? Carbon::now()->toDateString();
        $status = $request->input('status'); // bisa null

        // Query
        $query = Member_paket::with(['member.user', 'paket'])
            ->whereBetween('created_at', [$start, Carbon::parse($end)->endOfDay()])
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderByDesc('created_at');

        $results = $query->get();

        // Total Biaya
        $total_biaya = $results->sum(function ($item) {
            return $item->paket->biaya ?? 0;
        });

        return view('admin.laporans.penjualan', compact('results', 'start', 'end', 'status', 'total_biaya'));
    }
}
