<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SomeService;
use  Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    { 
        $datas = User::filter(request()->only(['search']))
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(request()->query());
        return view('user.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255','unique:users' ],
            'password' => ['required', 'string', 'min:4'],
        ]);

         User::create([
            'name'    => $request->name,
            'email'    => $request->name.'@gmail.com',
            'password'    => bcrypt($request->password),
         ]);

        return redirect()->route('user.index')->with(['success' => 'User Berhasil Ditambah!']);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changePassword($id)
    {
        $user = User::find($id);

        return view('user.change-password', compact('user'));
    }
    public function resetPassword(Request $request, User $user)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Hash and update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Password reset successfully.');
    }
 
     
    public function edit($id)
    {
        $data = User::find($id);
 
        return view('user.edit',[
            "data"=>$data,
        ]);
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255',Rule::unique('users')->ignore($id)],
            'password' => ['required', 'string', 'min:4'],
        ]); 
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('user.index')->with(['success' => 'User Berhasil Ditambah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request, $id)
    {
        $item = User::findOrFail($id);

        $item->delete();

        if ($item) {
            return redirect()->route("user.index")->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route("user.index")->with(['error' => 'Data Gagal Dihapus!']);
        }
    }


    public function hapusUser(Request $request)
    {
        $current_user = Auth::user();

        $user = User::find($request->id);
        $user->type = 'z';
        $user->removeRole($user->getRoleNames()[0]);
        $user->username =  $current_user->name;
        $user->user_id =  $current_user->id;
        $user->save();
        // $id = $request->id;

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);

        // $users = User::findOrFail($id);

        // $role_name = $users->getRoleNames();
        // $users->removeRole($role_name[0]);
        // $users->delete();
        // // $this->someService->deleteTemp($users->username);

        // if ($users) {
        //     //redirect dengan pesan sukses
        //     return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
        // } else {
        //     //redirect dengan pesan error
        //     return redirect()->route('user.index')->with(['error' => 'Data Gagal Dihapus!']);
        // }
    }
}
