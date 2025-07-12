<?php

namespace App\Http\Controllers;

use App\Models\Biro;
use App\Models\StrukturOrganisasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BiroController extends Controller
{
    protected $view = 'biro';
    public function index()
    {
        $view =$this->view ;
        $datas = Biro::filter(request()->only(['search']))
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
        $view =$this->view ;
        $artikel = Biro::where('id', $id)->first();

        $request->validate([
            'nama' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'gambar_pimpinan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email_pimpinan' => 'nullable|email|max:255',
            'content' => 'nullable|string',
        ]);


        $uniqueName = generateRandomString() . '.' . $request->nama_pimpinan;
        $data = $request->all();

        $imagePath = $request->file('gambar_pimpinan') ? 
                $request->file('gambar_pimpinan')->store("photos/$view/".$uniqueName, 'public') 
                : $artikel->gambar_pimpinan;        

        $data['gambar_pimpinan'] = $imagePath;  
        
        $artikel->update($data);
         return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

     }
    public function edit($id)
    {
        $view =$this->view ;
        $data = Biro::find($id);
        return view("$view.edit", [
            "data" => $data,
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());

      $view =$this->view ;

        $request->validate([
            'nama' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'gambar_pimpinan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email_pimpinan' => 'nullable|email|max:255',
            'content' => 'nullable|string',
        ]);

        $uniqueName = generateRandomString() . '.' . $request->nama_pimpinan;

        $data = $request->all();

        $imagePath = $request->file('gambar_pimpinan') ? 
                $request->file('gambar_pimpinan')->store("photos/$view/".$uniqueName, 'public') 
                : $request->gambar_pimpinan;
        $data['gambar_pimpinan'] = $imagePath;  

        try {
            Biro::create($data);
           
        } catch (Exception $e) {
            dd($e);
        }
        $view =$this->view ;
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $view =$this->view ;
        $item = Biro::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("$view.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
