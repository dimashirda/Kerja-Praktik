<?php
<<<<<<< HEAD
/**
 * Created by PhpStorm.
 * User: Sabila
 * Date: 7/19/2017
 * Time: 1:19 PM
 */

namespace App\Http\Controllers;


class AnakPerusahaanController
{
    public function index()
    {
        return view('anak_perusahaans.index');
    }

    public function create()
    {
        return view('anak_perusahaans.create');
    }
}
=======

namespace App\Http\Controllers;

use DB;
use App\Anak_perusahaan;

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
    	$a = new Anak_perusahaan();

    	$a->id_perusahaan = $req->input('id_anakperu');
		$a->nama_perusahaan = $req->input('nama_anakperu');
		$a->tlp_perusahaan = $req->input('tlp_anakperu');
		$a->email_perusahaan = $req->input('email_anakperu');

		$a->save();
		return redirect ('anak_perusahaans');
    }
    public function edit($id_perusahaan)
    {
    	$plg = Anak_perusahaan::find($id_perusahaan);
    	//dd($plg);
    	return view('anak_perusahaans.edit',['anak_perusahaans' => $plg]);
    }
    public function save(Request $data)
    {	
    	//dd($data);
    	$edit = Anak_perusahaan::where('id_perusahaan',$data['id_anakperu'])->first();
    	//dd($edit);
    	$edit->nama_pelanggan = $data['nama_anakperu'];
    	$edit->tlp_pelanggan = $data['tlp_anakperu'];
    	$edit->email_pelanggan = $data['email_anakperu'];
    	$edit->save();
    	return redirect('anak_perusahaans');
    }
    public function delete($id_perusahaan)
    {
    	$del = Anak_perusahaan::find($id_perusahaan);
    	$del->delete();
    	return redirect ('anak_perusahaans');
    }
}
>>>>>>> d12e427d68594c67f92910c0271fc1524aafe117
