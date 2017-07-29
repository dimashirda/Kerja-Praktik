<?php

namespace App\Http\Controllers;

use DB;
use App\Account_manager;

use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    protected $allNotif;
    public function __construct() {
        $this->allNotif = DB::table('Notifikasis')
            ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
            ->get();
    }

    public function index()
    {
        //$acc = DB::table('anak_perusahaans')->oldest()->get();
        $search = \Request::get('search');
        $category = \Request::get('kategori');
        if($category == "nama")
        {
            $acc = DB::table('account_managers')
            ->where('nama_am','like','%'.$search.'%')
            ->orderBy('nama_am')
            ->paginate(25);
        }
        elseif($category == "ID")
        {
            $acc = DB::table('account_managers')
            ->where('id_am','like','%'.$search.'%')
            ->orderBy('id_am')
            ->paginate(25);
        }
        else
        {
            $acc = DB::table('account_managers')->paginate(25);
        }
        return view('account_manager.index',['acc'=>$acc, 'allNotif'=>$this->allNotif]);

    }

    public function create()
    {
        return view('account_manager.create', ['allNotif'=>$this->allNotif]);
    }

    public function store(Request $req)
    {
        $acc = new Account_manager();

        $acc->id_am = $req->input('id_accm');
        $acc->nama_am = $req->input('nama_accm');
        $acc->tlp_am = $req->input('tlp_accm');
        $acc->email_am = $req->input('email_accm');

        $acc->save();
        $request->session()->flash('alert-success', 'Data Account Manager telah ditambahkan');
        return redirect ('/accmgr');
    }

    public function edit($id)
    {
        $acc = DB::table('account_managers')->where('id_am', $id)->first();
        // $acc = account_manager::find($id);
        return view ('account_manager.edit', ['acc' => $acc, 'allNotif'=>$this->allNotif]);
    }

    public function update(Request $req, $id_accmgr)
    {
        $id = $req->input('id_accm');
        $nama = $req->input('nama_accm');
        $tlp = $req->input('tlp_accm');
        $email = $req->input('email_accm');
        
        // $edit = Account_manager::where('id_am', $id)->first();
        // $edit->nama_am = $nama;
        // $edit->tlp_am = $tlp;
        // $edit->email_am = $email;
        // $edit->save();

        DB::table('account_managers')
            ->where('id_am', $id_accmgr)
            ->update(['nama_am' => $nama,
                    'tlp_am' => $tlp,
                    'email_am' => $email]);
        $req->session()->flash('alert-edit', 'Data Account Manager berhasil diubah');

        return redirect ('/accmgr');
    }

    public function delete(Request $request, $id_accmgr)
    {
        DB::table('account_managers')
            ->where('id_am', $id_accmgr)
            ->delete();

        // $del = account_manager::find($accm);
        // $del->delete();
        $request->session()->flash('alert-hapus', 'Data Account Manager berhasil dihapus');

        return redirect ('/accmgr');

    }
}