<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlumniController extends Controller
{
    protected $view = 'alumni';
    public function index()
    {
        $view = $this->view ;
        $datas = Alumni::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->paginate(10) // Paginate the results
            ->appends(request()->query());
        return view("$view.index", compact('datas'));
    }
    public function create()
    { 
        $view =$this->view ;
        return view("$view.create");
    }
    protected function generateSlug($judul)
    {   
        return Str::slug($judul, '-');
    }
    public function update(Request $request, $id)
    {
        // dd($request->file('image'));
        $view =$this->view ;
        $artikel = Alumni::where('id', $id)->first();

       
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'motivasi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);


        $uniqueName = generateRandomString() . '.' . $request->nama;

        $sendata = $request->all();

    
        $imagePath = $request->file('gambar') ? 
                $request->file('gambar')->store("photos/$view".$uniqueName, 'public') : $artikel->gambar;
        $sendata['gambar'] = $imagePath;

        $artikel->update($sendata);

         return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

    }
    public function edit($id)
    {
        $view =$this->view ;
        $data = Alumni::find($id);
        return view("$view.edit", [
            "data" => $data,
        ]);
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'motivasi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $uniqueName = generateRandomString() . '.' . $request->nama;

        $sendata = $request->all();
        $imagePath = $request->file('gambar') ? 
                $request->file('gambar')->store("photos/".$uniqueName, 'public') : $request->gambar;
        $sendata['gambar'] = $imagePath;
        try {
            Alumni::create($sendata);
           
        } catch (Exception $e) {
            dd($e);
        }
        $view =$this->view ;
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $view =$this->view ;
        $item = Alumni::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("$view.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
