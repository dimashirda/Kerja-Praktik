<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use DB;

class PelangganController extends Controller
{
    public function index()
    {
    	$pelanggan = DB::table('pelanggans')->oldest()->get();
    	return view('pelanggan.index',['pelanggan' => $pelanggan]);
    }
    public function create()
    {
    	return view('pelanggan.create');
    }
    public function store(Request $request)
    {	
    	//dd($request);
    	$pelanggan = new Pelanggan;
    	$pelanggan->nipnas = $request->input('nipnas');
    	$pelanggan->nama_pelanggan = $request->input('nama');
    	$pelanggan->tlp_pelanggan = $request->input('tlp');
    	$pelanggan->email_pelanggan = $request->input('email');
    	$pelanggan->save();
    	return redirect('/pelanggan');
    }
    public function edit($nipnas)
    {
    	$plg = pelanggan::find($nipnas);
    	//dd($plg);
    	return view('pelanggan.edit',['pelanggan' => $plg]);
    }
    public function save(Request $data)
    {	
    	//dd($data);
    	$edit = pelanggan::where('nipnas',$data['nipnas'])->first();
    	//dd($edit);
    	$edit->nama_pelanggan = $data['nama'];
    	$edit->tlp_pelanggan = $data['tlp'];
    	$edit->email_pelanggan = $data['email'];
    	$edit->save();
    	return redirect('/pelanggan');
    }
    public function delete($nipnas)
    {
    	$del = pelanggan::find($nipnas);
    	$del->delete();
    	return redirect ('/pelanggan');
    }
}
 