<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembur;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class LemburController extends Controller
{
    public function index()
    {
        $lemburs = Lembur::join('karyawans', 'karyawans.id', '=', 'lemburs.id_karyawan')
                    ->join('perusahaans', 'perusahaans.id', '=', 'karyawans.id_perusahaan')
                    ->where('perusahaans.idusers', '=', \Auth::user()->idusers)
                    ->select('karyawans.*', 'lemburs.*', 'lemburs.id as lembur_id')->get();
        return view('lembur.index', compact('lemburs'));
    }

    public function create()
    {
        $karyawans = Karyawan::where('karyawans.idusers', '=', \Auth::user()->idusers)->get();
        return view('lembur.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required|int',
            'tgl_lembur' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan_lembur' => 'required|string',
            'upah_tambahan' => 'required|int',
        ], [
            'tgl_lembur.required' => 'Mohon isi tgl. pelaksanaan lembur.',
            'jam_mulai.required' => 'Mohon isi jam mulai lembur.',
            'jam_selesai.required' => 'Mohon isi jam selesai lembur.',
            'keterangan_lembur.required' => 'Mohon isi keterangan lembur.',
            'upah_tambahan.required' => 'Mohon isi upah tambahan lembur.',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Lembur::create($request->all());
        return redirect()->route('lembur.index')->with('success', 'Lembur berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $lembur = Lembur::findOrFail($id);
        $karyawans = Karyawan::where('karyawans.idusers', '=', \Auth::user()->idusers)->get();;
        return view('lembur.edit', compact('lembur', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required|int',
            'tgl_lembur' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keterangan_lembur' => 'required|string',
            'upah_tambahan' => 'required|numeric',
        ], [
            'tgl_lembur.required' => 'Mohon isi tgl. pelaksanaan lembur.',
            'jam_mulai.required' => 'Mohon isi jam mulai lembur.',
            'jam_selesai.required' => 'Mohon isi jam selesai lembur.',
            'keterangan_lembur.required' => 'Mohon isi keterangan lembur.',
            'upah_tambahan.required' => 'Mohon isi upah tambahan lembur.',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lembur = Lembur::findOrFail($id);
        $lembur->update($request->all());
        return redirect()->route('lembur.index')->with('success', 'Lembur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lembur = Lembur::findOrFail($id);
        $lembur->delete();
        return redirect()->route('lembur.index')->with('success', 'Lembur berhasil dihapus.');
    }
    public function export(Request $request)
    {
        // Ambil data lembur
        $lemburs = Lembur::with('karyawan')->get();

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'Nama Karyawan');
        $sheet->setCellValue('B1', 'Tgl. Pelaksanaan Lembur');
        $sheet->setCellValue('C1', 'Jam Mulai');
        $sheet->setCellValue('D1', 'Jam Selesai');
        $sheet->setCellValue('E1', 'Keterangan Lembur');
        $sheet->setCellValue('F1', 'Upah Tambahan');

        // Isi data
        $row = 2;
        foreach ($lemburs as $lembur) {
            $sheet->setCellValue('A' . $row, $lembur->karyawan->nama);
            $sheet->setCellValue('B' . $row, $lembur->tgl_lembur);
            $sheet->setCellValue('C' . $row, $lembur->jam_mulai);
            $sheet->setCellValue('D' . $row, $lembur->jam_selesai);
            $sheet->setCellValue('E' . $row, $lembur->keterangan_lembur);
            $sheet->setCellValue('F' . $row, number_format($lembur->upah_tambahan, 2));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'lembur_report.xlsx';

        // Return the response to download the file
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="lembur_report.xlsx"',
            ]
        );
    }
}
