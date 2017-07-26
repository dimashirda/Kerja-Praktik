<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use DB;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $search = \Request::get('search');
        $category = \Request::get('kategori');
        if($category == "nama")
        {
            $pelanggan = DB::table('pelanggans')
            ->where('nama_pelanggan','like','%'.$search.'%')
            ->orderBy('nama_pelanggan')
            ->paginate(25);
        }
        elseif($category == "nipnas")
        {
            $pelanggan = DB::table('pelanggans')
            ->where('nipnas','like','%'.$search.'%')
            ->orderBy('nipnas')
            ->paginate(25);
        }
        else
        {
            $pelanggan = DB::table('pelanggans')->paginate(25);
        }
        return view('pelanggan.index',['pelanggan'=>$pelanggan]);
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
    public function save(Request $data, $nipnas)
    {	
    	//dd($data);
        $edit = pelanggan::where('nipnas',$nipnas)->first();
//
    	$edit->nama_pelanggan = $data['name'];
    	$edit->tlp_pelanggan = $data['tlp'];
    	$edit->email_pelanggan = $data['email'];
    	$edit->save();
    	return redirect('/pelanggan');
    }
    public function delete($nipnas)
    {
    	$del = pelanggan::where('nipnas',$nipnas);
    	$del->delete();
    	return redirect ('/pelanggan');
    }
}
 

