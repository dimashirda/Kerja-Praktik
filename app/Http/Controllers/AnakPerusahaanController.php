<?php

namespace App\Http\Controllers;

use DB;
use App\Anak_perusahaan;

use Illuminate\Http\Request;

class AnakPerusahaanController extends Controller
{
    public function index()
    {
    	$acc = DB::table('anak_perusahaans')->oldest()->paginate(25);
    	return view('anak_perusahaans.index',['acc'=>$acc]);
    }
    public function create()
    {
    	return view('anak_perusahaans.create');
    }
    public function store(request $req)
    {
    	$a = new Anak_perusahaan();

    	$a->id_perusahaan = $req->input('id_anakperu');
		$a->nama_perusahaan = $req->input('nama_anakperu');
		$a->tlp_perusahaan = $req->input('tlp_anakperu');
		$a->email_perusahaan = $req->input('email_anakperu');

		$a->save();
		return redirect ('/admin/perusahaan');
    }
    public function edit($id_perusahaan)
    {
    	$plg = Anak_perusahaan::find($id_perusahaan);
    	//dd($plg);
    	return view('anak_perusahaans.edit',['anak_perusahaans' => $plg]);
    }
    public function save(Request $data, $id_perusahaan)
    {	
    	//dd($data);
    	$edit = Anak_perusahaan::where('id_perusahaan',$id_perusahaan)->first();
    	//dd($edit);
    	$edit->nama_perusahaan = $data['nama_anakperu'];
    	$edit->tlp_perusahaan = $data['tlp_anakperu'];
    	$edit->email_perusahaan = $data['email_anakperu'];
    	$edit->save();
    	return redirect('/admin/perusahaan');
    }
    public function delete($id_perusahaan)
    {
    	$del = Anak_perusahaan::where('id_perusahaan',$id_perusahaan);
    	$del->delete();
    	return redirect ('/admin/perusahaan');
    }
}
