<?php

namespace App\Http\Controllers;

use App\Models\Biro;
use App\Models\Download;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\StrukturOrganisasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadController extends Controller
{
    protected $view = 'download';
    public function index()
    {
        $view = $this->view ;

        $datas = Download::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(request()->query());
        return view("$view.index", compact('datas'));
    }
    public function create()
    { 
        $view =$this->view ;
         return view("$view.create",);
    }
    protected function generateSlug($judul)
    {   
        return Str::slug($judul, '-');
    }
   public function update(Request $request, Download $download)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:5120', // max 5MB
        ]);

        $data = ['judul' => $request->judul];

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::delete('public/downloads/' . $download->nama_file);

            $file = $request->file('file');
            $ekstensi = $file->getClientOriginalExtension();
            $ukuranKb = $file->getSize() / 1024;
            $namaUnik = uniqid() . '.' . $ekstensi;

            $file->storeAs('public/downloads', $namaUnik);

            $data['nama_file'] = $namaUnik;
            $data['ekstensi'] = $ekstensi;
            $data['ukuran_kb'] = $ukuranKb;
            $data['tanggal_upload'] = now()->toDateString();
        }

        $download->update($data);
        $view =$this->view ;

        // $artikel->update($validated);
         return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

    }
    public function edit($id)
    {
        $view = $this->view ;
 
        $data = Download::find($id);
        return view("$view.edit", [
            "data" => $data,
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
        $request->validate([
          'judul' => 'required|string|max:255',
          'file' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:5120', // max 5MB
        ]); 
        
        $file = $request->file('file');
        $ekstensi = $file->getClientOriginalExtension();
        $ukuranKb = $file->getSize() / 1024;
        $namaUnik = uniqid() . '.' . $ekstensi;

        $file->storeAs('public/downloads', $namaUnik);

        
        try {
            Download::create([
                'judul' => $request->judul,
                'nama_file' => $namaUnik,
                'ekstensi' => $ekstensi,
                'ukuran_kb' => $ukuranKb,
                'tanggal_upload' => now()->toDateString(),
            ]);
        } catch (Exception $e) {
            dd($e);
        }
        $view =$this->view ;
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $view =$this->view ;
        $item = Download::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("$view.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
