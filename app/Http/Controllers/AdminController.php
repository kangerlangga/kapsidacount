<?php

namespace App\Http\Controllers;

use App\Models\Detection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //Fungsi untuk halaman dashboard
    public function index()
    {
        $now = time();
        $fiveMinutesAgo = $now - 300;
        $data = [
            'judul' => 'Dashboard',
            'cVO' => DB::table('sessions')->where('last_activity', '>=', $fiveMinutesAgo)->count(),
            'cP' => Detection::count(),
            'cK' => Detection::where('kekurangan', '>', 0)->count(),
        ];
        return view('pages.admin.dashboard', $data);
    }

    public function editProf()
    {
        $data = [
            'judul' => 'Edit Profile',
        ];
        return view('pages.admin.profile_edit', $data);
    }

    public function updateProf(Request $request)
    {
        $passProf = User::findOrFail(Auth::user()->id);

        if (password_verify($request->password, $passProf->password)) {
            // validate form
            $request->validate([
                'Nama'      => 'required|max:45',
                'Address'   => 'required|max:255',
                'Position'  => 'required|max:255',
                'Phone'     => 'required|numeric|max_digits:20',
            ]);

            //get by ID
            $profil = User::findOrFail(Auth::user()->id);

            //update
            $profil->update([
                'name'          => $request->Nama,
                'alamat'        => $request->Address,
                'jabatan'       => $request->Position,
                'telp'          => $request->Phone,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('admin.dash')->with(['successprof' => 'Your Account has been Updated!']);
        }else{
            return redirect()->route('prof.edit')->with(['passerror' => 'Your Password is Incorrect!']);
        }
    }

    public function editPass()
    {
        $data = [
            'judul' => 'Change Password',
        ];
        return view('pages.admin.profile_editpass', $data);
    }

    public function updatePass(Request $request)
    {
        $passEdit = User::findOrFail(Auth::user()->id);

        if (password_verify($request->oldPass, $passEdit->password)) {
            // validate form
            $request->validate([
                'Confirm-Pass'  => 'required|same:newPass',
            ]);

            //get by ID
            $profil = User::findOrFail(Auth::user()->id);

            $newPass = password_hash($request->newPass, PASSWORD_DEFAULT);

            //update
            $profil->update([
                'password'    => $newPass,
                'modified_by' => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('prof.edit.pass')->with(['success' => 'Your Password has been Updated!']);
        }else{
            return redirect()->route('prof.edit.pass')->with(['error' => 'Your Current Password is Incorrect!']);
        }
    }
}
