<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $datas = Artikel::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->paginate(10) // Paginate the results
            ->appends(request()->query());
        return view('artikel.index', compact('datas'));
    }
     public function create()
    { 
        return view('artikel.create');
    }
   protected function generateSlug($judul)
    {   
        return Str::slug($judul, '-');
    }
    public function update(Request $request, $id)
    {
        // dd($request->file('image'));
        $artikel = Artikel::where('id', $id)->first();

        $request->validate([
            'judul'    => 'required|string|max:255',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content'  => 'required|string',
            'kategori' => 'required',
        ]);

        $uniqueName = generateRandomString() . '.' . $request->judul;

        $imagePath = $request->file('image') ? 
                $request->file('image')->store('photos/'.$uniqueName, 'public') : $artikel->image;
 
        $slug = $this->generateSlug($request->judul);
        $artikel->update([
                'judul'     => $request->judul,
                'slug'     => $slug,
                'penulis'     => $request->penulis,
                'image'     =>  $imagePath, // simpan path jika ada
                'content'   => $request->content,
                'kategori'  => $request->kategori
            ]);
         return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Di Edit!']);

     }
    public function edit($id)
    {
        $data = Artikel::find($id);
 
        return view('artikel.edit', [
            "data" => $data,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content'  => 'required|string',
            'kategori' => 'required',
        ]);

        $uniqueName = generateRandomString() . '.' . $request->judul;

        $imagePath = $request->file('image') ? 
                $request->file('image')->store('photos/'.$uniqueName, 'public') : null;
 
        $slug = $this->generateSlug($request->judul);
        try {
            Artikel::create([
                'judul'     => $request->judul,
                'slug'     => $slug,
                'penulis'     => $request->penulis,
                'image'     => $imagePath, // simpan path jika ada
                'content'   => $request->content,
                'kategori'  => $request->kategori
            ]);
           
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $item = Artikel::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('artikel.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
