<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->level == 'Super Admin') {
            $data = [
                'judul' => 'Users Management',
                'DataU' => User::latest()->get(),
            ];
            return view('pages.admin.user', $data);
        }else{
            return redirect()->route('admin.dash');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->level == 'Super Admin') {
            $data = [
                'judul' => 'New Account User',
            ];
            return view('pages.admin.user_add', $data);
        }else{
            return redirect()->route('admin.dash');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->level == 'Super Admin') {
            // validate form
            $request->validate([
                'Nama'      => 'required|max:45',
                'Email'     => 'required|email|unique:users,email|max:255',
                'Address'   => 'required|max:255',
                'Position'  => 'required|max:255',
                'Phone'     => 'required|numeric|max_digits:20',
            ]);

            $defPass = 'Kapsida.CountHS6716';
            $sandi = password_hash($defPass, PASSWORD_DEFAULT);

            User::create([
                'id_akun'       => 'Akun'.Str::random(33),
                'name'          => $request->Nama,
                'email'         => $request->Email,
                'password'      => $sandi,
                'alamat'        => $request->Address,
                'jabatan'       => $request->Position,
                'telp'          => $request->Phone,
                'level'         => $request->Level,
                'created_by'    => Auth::user()->email,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('user.add')->with(['success' => 'User has been Added!']);
        }else{
            return redirect()->route('admin.dash');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_akun)
    {
        if (Auth::user()->level == 'Super Admin') {
            //get by ID
            $getID = User::where('id_akun', $id_akun)->first();
            $akun = User::findOrFail($getID->id);
            if ($akun->id_akun == Auth::user()->id_akun) {
                //redirect to index
                return redirect()->route('prof.edit');
            }else{
                $data = [
                    'judul' => 'Edit Account User',
                    'EditUser' => $akun,
                ];
                return view('pages.admin.user_edit', $data);
            }
        }else{
            return redirect()->route('admin.dash');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_akun)
    {
        if (Auth::user()->level == 'Super Admin') {
            //validate form
            $request->validate([
                'Nama'      => 'required|max:45',
                'Address'   => 'required|max:255',
                'Position'  => 'required|max:255',
                'Phone'     => 'required|numeric|max_digits:20',
            ]);

            $getID = User::where('id_akun', $id_akun)->first();
            $akun = User::findOrFail($getID->id);

            //update
            $akun->update([
                'name'          => $request->Nama,
                'alamat'        => $request->Address,
                'jabatan'       => $request->Position,
                'telp'          => $request->Phone,
                'level'         => $request->Level,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('user.data')->with(['success' => 'User has been Updated!']);
        }else{
            return redirect()->route('admin.dash');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_akun)
    {
        if (Auth::user()->level == 'Super Admin') {
            //get by ID
            $getID = User::where('id_akun', $id_akun)->first();
            $akun = User::findOrFail($getID->id);
            if ($akun->id_akun == Auth::user()->id_akun) {
                //redirect to index
                return redirect()->route('user.data')->with(['error' => 'User Failed to be Deleted!']);
            }else{
                //delete
                $akun->delete();
                //redirect to index
                return redirect()->route('user.data')->with(['success' => 'User has been Deleted!']);
            }
        }else{
            return redirect()->route('admin.dash');
        }
    }

    public function resetPass(string $id_akun)
    {
        if (Auth::user()->level == 'Super Admin') {
            //get by ID
            $getID = User::where('id_akun', $id_akun)->first();
            $akun = User::findOrFail($getID->id);
            if ($akun->id_akun == Auth::user()->id_akun) {
                //redirect to index
                return redirect()->route('user.data')->with(['error' => 'Password Failed to be Reset!']);
            }else{
                $defPass = 'Kapsida.CountHS6716';
                $sandi = password_hash($defPass, PASSWORD_DEFAULT);
                //update
                $akun->update([
                    'password'    => $sandi,
                    'modified_by' => Auth::user()->email,
                ]);
                //redirect to index
                return redirect()->route('user.data')->with(['success' => 'Password has been Reset!']);
            }
        }else{
            return redirect()->route('admin.dash');
        }
    }
}
