<?php

namespace App\Http\Controllers;

use App\Models\BukuPanduan;
use App\Models\Fakultas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BukuPanduanController extends Controller
{
    protected $view = 'buku_panduan';
    public function index()
    {
        $view = $this->view ;

        $datas = BukuPanduan::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(request()->query());
        return view("$view.index", compact('datas'));
    }
    public function create()
    { 
        $view =$this->view ;
        $fakultas =  Fakultas::select('id','nama','singkatan')->get();
        return view("$view.create",compact('fakultas'));
    }
    protected function generateSlug($judul)
    {   
        return Str::slug($judul, '-');
    }
    public function update(Request $request, $id)
    { 
        $view =$this->view ;
        $artikel = BukuPanduan::where('id', $id)->first();
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255', 
            'tahun' => 'nullable|max:4', 
            // 'tahun' => ['required','digits:4','regex:/^\d{4}$/'],
            'nama_file' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:5120',
        ]);
        $file = $request->file('nama_file');
        $ekstensi = $file->getClientOriginalExtension();
        $namaUnik = uniqid() . '.' . $ekstensi;

        $file->storeAs('public/buku_panduan', $namaUnik);

        $validated['nama_file'] = $namaUnik;

        $artikel->update($validated);
        return redirect()->route("buku-panduan.index")->with(['success' => 'Data Berhasil Di Edit!']);

     }
    public function edit($id)
    {
        $view =$this->view ;
        $fakultas =  Fakultas::select('id','nama','singkatan')->get();

        $data = BukuPanduan::find($id);
        return view("$view.edit", [
            "data" => $data,
            "fakultas" => $fakultas
        ]);
    }
   protected function convertRupiahToInt($rupiah)
    {
        // Hilangkan "Rp.", spasi biasa, dan non-breaking space (\u{A0})
        $cleaned = str_replace(['Rp.', ' ', "\u{A0}"], '', $rupiah);

        // Hilangkan tanda titik sebagai pemisah ribuan
        $cleaned = str_replace('.', '', $cleaned);

        // Ubah ke integer
        return (int) $cleaned;
    }

    public function store(Request $request)
    {
        $view =$this->view ;
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255', 
            'tahun' => 'nullable|max:4', 
            // 'tahun' => ['required','digits:4','regex:/^\d{4}$/'],
            'nama_file' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:5120',
        ]);
    
        $file = $request->file('nama_file');
        $ekstensi = $file->getClientOriginalExtension();
        $namaUnik = uniqid() . '.' . $ekstensi;

        $file->storeAs('public/buku_panduan', $namaUnik);

        $validated['nama_file'] = $namaUnik;

        try {
            BukuPanduan::create($validated);
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route("buku-panduan.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $view =$this->view ;
        $item = BukuPanduan::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("buku-panduan.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("buku-panduan.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
