<?php

namespace App\Http\Controllers;

use App\Models\Biro;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\StrukturOrganisasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FakultasController extends Controller
{
    protected $view = 'fakultas';
    public function index()
    {
        $view =$this->view ;
        $datas = Fakultas::filter(request()->only(['search']))
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
        $artikel = Fakultas::where('id', $id)->first();

        $request->validate([
            'nama' => 'nullable|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'program' => 'nullable|string|max:255'
        ]);


        $data = $request->all();
 
        $artikel->update($data);
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

     }
    public function edit($id)
    {
        $view =$this->view ;
        $data = Fakultas::find($id);
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
            'singkatan' => 'nullable|string|max:255',
            'program' => 'nullable|string|max:255'
        ]);
 
        $data = $request->all();

         
        try {
            Fakultas::create($data);
        } catch (Exception $e) {
            dd($e);
        }
        $view =$this->view ;
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $view =$this->view ;
        $item = Fakultas::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("$view.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
