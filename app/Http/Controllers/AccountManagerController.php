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
            ->where('notifikasis.flag','=','0')
            ->get();
    }

    public function index()
    {
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
        $cek = DB::table('account_managers')->where('id_am', '=', $req->input('id_accm'));
        if(count($cek)){
            $req->session()->flash('alert-danger', 'Data Account Manager gagal ditambahkan. NIK Account Manager sudah digunakan.');
            return redirect ('/accmgr/create');
        }
        else{
            $acc = new Account_manager();
            $acc->id_am = $req->input('id_accm');
            $acc->nama_am = $req->input('nama_accm');
            $acc->tlp_am = $req->input('tlp_accm');
            $acc->email_am = $req->input('email_accm');
            
            if($acc->save()){
                $req->session()->flash('alert-success', 'Data Account Manager telah ditambahkan.');
                return redirect ('/accmgr/create');        
            }
            else{
                $req->session()->flash('alert-danger', 'Data Account Manager gagal ditambahkan.');
                return redirect ('/accmgr/create');
            }
        }
    }

    public function edit($id)
    {
        $acc = DB::table('account_managers')->where('id_am', $id)->first();
        return view ('account_manager.edit', ['acc' => $acc, 'allNotif'=>$this->allNotif]);
    }

    public function update(Request $req, $id_accmgr)
    {
        $id = $req->input('id_accm');
        $nama = $req->input('nama_accm');
        $tlp = $req->input('tlp_accm');
        $email = $req->input('email_accm');
       
        $upd = DB::table('account_managers')
            ->where('id_am', $id_accmgr)
            ->update(['nama_am' => $nama,
                    'tlp_am' => $tlp,
                    'email_am' => $email]);
            
        if($upd){
            $req->session()->flash('alert-success', 'Data Account Manager berhasil diubah.');
            return redirect ('/accmgr');
        }
        else{
            $req->session()->flash('alert-danger', 'Data Account Manager gagal diubah.');
            return redirect ('/accmgr');   
        }
    }

    public function delete(Request $request, $id_accmgr)
    {
        $del = DB::table('account_managers')
            ->where('id_am', $id_accmgr)
            ->delete();

        if($del){
            $request->session()->flash('alert-success', 'Data Account Manager berhasil dihapus.');
            return redirect ('/accmgr');    
        }
        else{
            $request->session()->flash('alert-danger', 'Data Account Manager gagal dihapus.');
            return redirect ('/accmgr');    
        }
    }
}