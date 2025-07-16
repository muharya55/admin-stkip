<?php

namespace App\Http\Controllers;
use App\Models\KalenderAkademik;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KalenderAkademikController extends Controller
{
    protected $view = 'kalender_akademik';
    public function index()
    {
        $view =$this->view ;
        $datas = KalenderAkademik::filter(request()->only(['search']))
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
        $artikel = KalenderAkademik::where('id', $id)->first();
        
        $validated = $request->validate([
            'kegiatan' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'semester' => 'nullable|string|max:50',
            'is_active' => 'nullable|string',
        ]);

        $artikel->update($validated);
        return redirect()->route("kalender-akademik.index")->with(['success' => 'Data Berhasil Di Edit!']);
    }
    public function edit($id)
    {
        $view =$this->view ;
        $data = KalenderAkademik::find($id);
        return view("$view.edit", [
            "data" => $data,
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
 
        $validated = $request->validate([
            'kegiatan' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'semester' => 'nullable|string|max:50',
            'is_active' => 'nullable|string',
        ]);
 
        try {
            KalenderAkademik::create($validated);
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route("kalender-akademik.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $item = KalenderAkademik::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("kalender-akademik.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("kalender-akademik.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
