<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\StrukturOrganisasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    protected $view = 'galeri';
    public function index()
    {
        $view =$this->view ;
        $datas = Galeri::filter(request()->only(['search']))
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
        $artikel = Galeri::where('id', $id)->first();

        $request->validate([
            'deskripsi'    => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uniqueName = generateRandomString() . '.' . $request->deskripsi;

        $imagePath = $request->file('gambar') ? 
                $request->file('gambar')->store("photos/$view".$uniqueName, 'public') : $artikel->gambar;
        $artikel->update([
                'deskripsi'     => $request->deskripsi, 
                'gambar'     =>  $imagePath, 
            ]);
         return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

     }
    public function edit($id)
    {
        $view =$this->view ;
        $data = Galeri::find($id);
        return view("$view.edit", [
            "data" => $data,
        ]);
    }
    public function store(Request $request)
    {
      $view =$this->view ;

        $request->validate([
            'deskripsi'    => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uniqueName = generateRandomString() . '.' . $request->deskripsi;

       
        $imagePath = $request->file('gambar') ? 
                $request->file('gambar')->store("photos/$view/".$uniqueName, 'public') : $request->gambar;
                 
        try {
            Galeri::create([
                'deskripsi'     => $request->deskripsi, 
                'gambar'     =>  $imagePath, 
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
        $item = Galeri::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("$view.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
