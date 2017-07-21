<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Layanan;

class LayananController extends Controller
{
    public function index()
    {
    	$layanan = DB::table('layanans')->oldest()->get();
    	return view('layanan.index',['layanan' => $layanan]);
    }
    public function create()
    {
    	return view('layanan.create');
    }
    public function store(Request $request)
    {	
    	//dd($request);
    	$layanan = new layanan;
    	$layanan->id_layanan = $request->input('id');
    	$layanan->nama_layanan = $request->input('nama');
    	//$layanan->deskripsi = $request->input('desk');
    	$layanan->save();
    	return redirect('/layanan');
    }
    public function edit($id)
    {
    	$lyn = layanan::find($id);
    	//dd($plg);
    	return view('layanan.edit',['layanan' => $lyn]);
    }
    public function save(Request $data)
    {	
    	//dd($data);
    	$edit = layanan::where('id_layanan',$data['id'])->first();
    	//dd($edit);
    	$edit->nama_layanan = $data['nama'];
    	//$edit->deskripsi = $data['desk'];
    	//$edit->email_pelanggan = $data['email'];
    	$edit->save();
    	return redirect('/layanan');
    }
    public function delete($id)
    {
    	$del = layanan::find($id);
    	$del->delete();
    	return redirect ('/layanan');
    }
}
