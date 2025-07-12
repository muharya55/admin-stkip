<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $datas = Kelas::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->with('tahunAjaran') // Urutkan berdasarkan created_at
            ->paginate(10) // Paginate the results
            ->appends(request()->query());
        return view('kelas.index', compact('datas'));
    }
    public function create()
    {
        $tahunajaran = TahunAjaran::select('slug', 'tahun_awal', 'tahun_akhir')->get();

        return view('kelas.create', compact('tahunajaran'));
    }

    public function edit($id)
    {
        $data = Kelas::find($id);
        $tahunajaran = TahunAjaran::select('slug', 'tahun_awal', 'tahun_akhir')->get();

        return view('kelas.edit', [
            "data" => $data,
            "tahunajaran" => $tahunajaran
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas',
            'tahun_ajaran' => 'required|string',
            'nama_wali_kelas' => 'string',
        ]);
        // $biaya = extractIntegerFromString($request->biaya);
        $kode = generateRandomString();

        try {
            Kelas::create([
                'nama_kelas' => $request->nama_kelas,
                'kode_tahun_ajaran' => $request->tahun_ajaran,
                'nama_wali_kelas' => $request->nama_wali_kelas,
                'kode' => $kode
            ]);
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function update(Request $request, $kode)
    {

        $siswa = Kelas::where('kode', $kode)->first();

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kode_tahun_ajaran' => 'required|string',
            'nama_wali_kelas' => 'string',
        ]);
        $kode = 'kls' . generateRandomString();

        $siswa->update([
            'nama_kelas' => $request->nama_kelas,
            'kode_tahun_ajaran' => $request->kode_tahun_ajaran,
            'nama_wali_kelas' => $request->nama_wali_kelas,
        ]);

        return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Di Edit!']);

        // return redirect()->route('kelas.index')->with(['success', 'Data Berhasil Di Edit!']);
    }
    public function show($id)
    {
        $item = Kelas::find($id);

        return view('kelas.view', compact('item'));
    }
    public function destroy(Request $request, $id)
    {
        $item = Kelas::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('kelas.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
