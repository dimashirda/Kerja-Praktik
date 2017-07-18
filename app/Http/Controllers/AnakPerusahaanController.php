<?php

namespace App\Http\Controllers;

use DB;
use App\Anak_perusahaans;

use Illuminate\Http\Request;

class AnakPerusahaanController extends Controller
{
    public function index()
    {
    	$acc = DB::table('anak_perusahaans')->oldest()->get();
    	return view('anak_perusahaans.index',['acc'=>$acc]);
    }
    public function create()
    {
    	return view('anak_perusahaans.create');
    }
    public function store(request $req)
    {
    	$a = new Anak_perusahaans();

    	$a->id_perusahaan = $req->input('id_peru');
		$a->nama_perusahaan = $req->input('nama_peru');
		$a->tlp_perusahaan = $req->input('tlp_peru');
		$a->email_perusahaan = $req->input('email_peru');

		$a->save();
		return redirect ('an_perusahaan');
    }
    public function save()
    {

    }
}
