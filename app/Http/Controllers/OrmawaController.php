<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Ormawa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrmawaController extends Controller
{
    protected $view = 'ormawa';
    public function index()
    {
        $view = $this->view ;
        $datas = Ormawa::filter(request()->only(['search']))
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
        $artikel = Ormawa::where('id', $id)->first();

       
        $request->validate([
            'nama_ormawa' => 'nullable|string|max:255',
        ]);

 
        $sendata = $request->all();
 
        $artikel->update($sendata);

         return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

    }
    public function edit($id)
    {
        $view =$this->view ;
        $data = Ormawa::find($id);
        return view("$view.edit", [
            "data" => $data,
        ]);
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'nama_ormawa' => 'nullable|string|max:255', 
        ]);
 
        $sendata = $request->all(); 
        try {
            Ormawa::create($sendata);
           
        } catch (Exception $e) {
            dd($e);
        }
        $view =$this->view ;
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $view =$this->view ;
        $item = Ormawa::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("$view.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
