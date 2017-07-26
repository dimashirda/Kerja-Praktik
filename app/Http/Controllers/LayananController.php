<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Layanan;

class LayananController extends Controller
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
            $layanan = DB::table('layanans')
            ->where('nama_layanan','like','%'.$search.'%')
            ->orderBy('nama_layanan')
            ->paginate(25);
        }
        elseif($category == "ID")
        {
            $layanan = DB::table('layanans')
            ->where('id_layanan','like','%'.$search.'%')
            ->orderBy('id_layanan')
            ->paginate(25);
        }
        else
        {
            $layanan = DB::table('layanans')->paginate(25);
        }
        return view('layanan.index',['layanan'=>$layanan]);
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

