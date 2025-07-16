<?php

namespace App\Http\Controllers;

use App\Models\Biro;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\StrukturOrganisasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdiController extends Controller
{
    protected $view = 'prodi';
    public function index()
    {
        $view = $this->view ;

        $datas = Jurusan::filter(request()->only(['search']))
            ->with('fakultas')
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
        $artikel = Jurusan::where('id', $id)->first();
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'fakultas_id' => 'nullable',
            'ukt1' => 'nullable|string',
            'ukt2' => 'nullable|string',
            'ukt3' => 'nullable|string',
            'ukt4' => 'nullable|string',
            'ukt5' => 'nullable|string',
            'ukt6' => 'nullable|string',
            'ukt7' => 'nullable|string',
            'ukt8' => 'nullable|string',
        ]);

        // Ubah nilai UKT jadi integer
        for ($i = 1; $i <= 8; $i++) {
            $key = "ukt{$i}";
            $validated[$key] = isset($validated[$key])
                ? $this->convertRupiahToInt($validated[$key])
                : 0;
        }
        $artikel->update($validated);
         return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Di Edit!']);

     }
    public function edit($id)
    {
        $view =$this->view ;
        $fakultas =  Fakultas::select('id','nama','singkatan')->get();

        $data = Jurusan::find($id);
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
            'nama' => 'nullable|string|max:255',
            'fakultas_id' => 'nullable|integer',
            'ukt1' => 'nullable|string',
            'ukt2' => 'nullable|string',
            'ukt3' => 'nullable|string',
            'ukt4' => 'nullable|string',
            'ukt5' => 'nullable|string',
            'ukt6' => 'nullable|string',
            'ukt7' => 'nullable|string',
            'ukt8' => 'nullable|string',
        ]);

        // Ubah nilai UKT jadi integer
        for ($i = 1; $i <= 8; $i++) {
            $key = "ukt{$i}";
            $validated[$key] = isset($validated[$key])
                ? $this->convertRupiahToInt($validated[$key])
                : 0;
        }

        try {
            Jurusan::create($validated);
        } catch (Exception $e) {
            dd($e);
        }
        $view =$this->view ;
        return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Ditambah!']);
    }
    public function destroy(Request $request, $id)
    {
        $view =$this->view ;
        $item = Jurusan::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("$view.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("$view.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
