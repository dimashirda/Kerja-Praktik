<?php

namespace App\Http\Controllers;

use DB;
use App\Account_manager;

use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
	public function index()
	{
		$acc = DB::table('Account_managers')->oldest()->get();
		return view('account_manager.index', ['acc' => $acc]);
	}


    public function create()
    {
    	return view('account_manager.create');
    }

    public function store(Request $req)
    {
    	$acc = new Account_manager();

    	$acc->id_am = $req->input('id_accm');
    	$acc->nama_am = $req->input('nama_accm');
    	$acc->tlp_am = $req->input('tlp_accm');
    	$acc->email_am = $req->input('email_accm');

    	$acc->save();
    	return redirect ('acc-mgr');
    }

    public function edit($id)
    {
    	$acc = DB::table('account_managers')->where('id_am', $id)->first();
    	// $acc = account_manager::find($id);
    	return view ('account_manager.edit', ['acc' => $acc]);
    }

    public function update(Request $req)
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
    		->where('id_am', $id)
    		->update(['nama_am' => $nama,
    				'tlp_am' => $tlp,
    				'email_am' => $email]);
    	return redirect ('acc-mgr');
    }

    public function delete($id)
    {
    	DB::table('account_managers')
    		->where('id_am', $id)
    		->delete();

    	// $del = account_manager::find($accm);
    	// $del->delete();
    	return redirect ('acc-mgr');

    }
}