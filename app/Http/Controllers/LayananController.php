<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Layanan;

class LayananController extends Controller
{

    protected $allNotif;
    public function __construct() {
        $this->allNotif = DB::table('Notifikasis')
            ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
            ->get();
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
        return view('layanan.index',['layanan'=>$layanan, 'allNotif'=>$this->allNotif]);
    }
    
    public function create()
    {
    	return view('layanan.create', ['allNotif'=>$this->allNotif]);
    }
    public function store(Request $request)
    {	
    	//dd($request);
    	$layanan = new layanan;
    	$layanan->id_layanan = $request->input('id');
    	$layanan->nama_layanan = $request->input('nama');

    	//$layanan->deskripsi = $request->input('desk');

    	$layanan->save();
        $request->session()->flash('alert-success', 'Layanan telah ditambahkan');
    	return redirect('/layanan');
    }
    public function edit($id)
    {
    	$lyn = layanan::find($id);
    	//dd($plg);
    	return view('layanan.edit',['layanan' => $lyn, 'allNotif'=>$this->allNotif]);
    }
    public function save(Request $data, $id)
    {	
//    	dd($data);
    	$edit = layanan::where('id_layanan',$id)->first();
//    	dd($edit);
    	$edit->nama_layanan = $data['nama'];
    	//$edit->deskripsi = $data['desk'];
    	//$edit->email_pelanggan = $data['email'];
    	$edit->save();
        $data->session()->flash('alert-edit', 'Layanan berhasil diubah');

        return redirect('/layanan');
    }
    public function delete(Request $data, $id)
    {
    	$del = layanan::find($id);
    	$del->delete();
        $data->session()->flash('alert-hapus', 'Layanan berhasil dihapus');
        return redirect ('/layanan');
    }
}

