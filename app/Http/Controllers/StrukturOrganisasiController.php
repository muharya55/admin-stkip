<?php

namespace App\Http\Controllers;
 
use App\Models\StrukturOrganisasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StrukturOrganisasiController extends Controller
{
    protected $view = 'struktur_organisasi';
    public function index()
    {
        $view =$this->view ;
        $datas = StrukturOrganisasi::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->paginate(10)  
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
        $view =$this->view ;
        $data = StrukturOrganisasi::where('id', $id)->first();

         $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'nullable|string|max:255',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'nullable|string|max:255', 
        ]);

        $uniqueName = generateRandomString() . '.' . $request->nama;
        $view = $this->view ;

        $imagePath = $request->file('gambar') ? 
                $request->file('gambar')->store("photos/$view".$uniqueName, 'public') : $data->gambar;
                $datas = $request->all();

        $datas['gambar'] = $imagePath;

        try {
            $data->update($datas);
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route("struktur-organisasi.index")->with(['success' => 'Data Berhasil Di Edit!']);

     }
    public function edit($id)
    {
        $view =$this->view ;
        $data = StrukturOrganisasi::find($id);
 
        return view("$view.edit", [
            "data" => $data, 
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
         $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'nullable|string|max:255',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'nullable|string|max:255', 
        ]);

        $view =$this->view ;

        $uniqueName = generateRandomString() . '.' . $request->nama;
        $data = $request->all();

        $imagePath = $request->file('gambar') ? 
                $request->file('gambar')->store("photos/$view/".$uniqueName, 'public') : $request->gambar;
        $data['gambar'] = $imagePath;
        try {
            StrukturOrganisasi::create($data);
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route("struktur-organisasi.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $item = StrukturOrganisasi::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("struktur-organisasi.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("struktur-organisasi.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
