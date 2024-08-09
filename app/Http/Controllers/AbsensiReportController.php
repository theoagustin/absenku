<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Bagian; // Add this import
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class AbsensiReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $departmentId = $request->input('department_id', null);
        
        $karyawans = Karyawan::with(['absensis' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }])->when($departmentId, function ($query, $departmentId) {
            $query->where('id_bagian', $departmentId);
        })->where('idusers', Auth::user()->idusers)->get();

        $departments = Bagian::where('idusers', Auth::user()->idusers)->get();

        return view('absensi.report', compact('karyawans', 'startDate', 'endDate', 'departments', 'departmentId'));
    }

    public function detail($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $absensis = Absensi::where('id_karyawan', $id)->get();

        return response()->json([
            'karyawan' => $karyawan,
            'absensis' => $absensis
        ]);
    }
    public function export(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $departmentId = $request->input('department_id', null);

        $karyawans = Karyawan::with(['absensis' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }])->when($departmentId, function ($query, $departmentId) {
            $query->where('id_bagian', $departmentId);
        })->where('idusers', Auth::user()->idusers)->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header
        $sheet->setCellValue('A1', 'Nama Karyawan');
        $sheet->setCellValue('B1', 'Kehadiran');
        $sheet->setCellValue('C1', 'Sakit');
        $sheet->setCellValue('D1', 'Ijin');
        $sheet->setCellValue('E1', 'Alpa');
        $sheet->setCellValue('F1', 'Telat');

        // Populate data
        $row = 2; // Start on row 2
        foreach ($karyawans as $karyawan) {
            $kehadiran = $karyawan->absensis->where('status_kehadiran', 'h')->count();
            $sakit = $karyawan->absensis->where('status_kehadiran', 's')->count();
            $ijin = $karyawan->absensis->where('status_kehadiran', 'i')->count();
            $alpa = $karyawan->absensis->where('status_kehadiran', 'a')->count();
            $telat = $karyawan->absensis->where('status_kehadiran', 't')->count();

            $sheet->setCellValue('A' . $row, $karyawan->nama);
            $sheet->setCellValue('B' . $row, $kehadiran);
            $sheet->setCellValue('C' . $row, $sakit);
            $sheet->setCellValue('D' . $row, $ijin);
            $sheet->setCellValue('E' . $row, $alpa);
            $sheet->setCellValue('F' . $row, $telat);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'absensi_report.xlsx';

        // Return the response to download the file
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="absensi_report.xlsx"',
            ]
        );
    }
}
