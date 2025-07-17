<?php

namespace App\Http\Controllers;

use App\Models\BukuPanduan;
use App\Models\Fakultas;
use App\Models\Utilities;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UtilitiesController extends Controller
{
    protected $view = 'utilities';
    public function index()
    {
        $view = $this->view ;

        $datas = Utilities::filter(request()->only(['search']))
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
        $artikel = Utilities::where('id', $id)->first();
        $validated = $request->validate([
            'slug' => 'nullable|string|max:255', 
            'data'  => 'nullable|string',
        ]);
     
        $artikel->update($validated);
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

    }
    public function edit($id)
    {
        $view =$this->view ;
        $fakultas =  Fakultas::select('id','nama','singkatan')->get();

        $data = Utilities::find($id);
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
            'slug' => 'nullable|string|max:255', 
            'content'  => 'nullable|string',
        ]);
     
        try {
            Utilities::create($validated);
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
   
}
