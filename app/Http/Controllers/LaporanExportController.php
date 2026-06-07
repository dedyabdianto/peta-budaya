<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanExportController
{
    public function __invoke(Request $request): StreamedResponse
    {
        $laporans = Laporan::query()
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->search, fn ($q, $search) => $q->where(function ($q) use ($search) {
                $q->where('nama_situs', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%");
            }))
            ->latest()
            ->get();

        $filename = 'laporan-verifikasi-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () use ($laporans) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, ['ID', 'Tanggal', 'Nama Situs', 'Lokasi', 'Latitude', 'Longitude', 'Pelapor', 'Kontak', 'Deskripsi', 'Status', 'Catatan Admin']);

            foreach ($laporans as $l) {
                fputcsv($file, [
                    $l->id,
                    $l->created_at->format('d/m/Y H:i'),
                    $l->nama_situs,
                    $l->lokasi,
                    $l->latitude,
                    $l->longitude,
                    $l->nama_pelapor,
                    $l->kontak,
                    $l->deskripsi,
                    $l->status,
                    $l->catatan_admin,
                ]);
            }
            fclose($file);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
