<?php

namespace App\Http\Controllers;

use App\Models\BukuPanduan;
use App\Models\Contact;
use App\Models\Fakultas;
use App\Models\Utilities;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    protected $view = 'contact';
    public function index()
    {
        $view = $this->view ;

        $datas = Contact::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(request()->query());
        return view("$view.index", compact('datas'));
    }
    
   
}
