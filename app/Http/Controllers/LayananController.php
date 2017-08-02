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
            ->where('notifikasis.flag','=','0')
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
    	$layanan = new layanan;
    	$layanan->nama_layanan = $request->input('nama');
    	
        if($layanan->save()){
            $request->session()->flash('alert-success', 'Layanan telah ditambahkan.');
            return redirect('/layanan');
        }
        else{
            $request->session()->flash('alert-danger', 'Layanan gagal ditambahkan.');
            return redirect('/layanan'); 
        }
    }

    public function edit($id)
    {
    	$lyn = layanan::find($id);
    	return view('layanan.edit',['layanan' => $lyn, 'allNotif'=>$this->allNotif]);
    }

    public function save(Request $data, $id)
    {	
    	$edit = layanan::where('id_layanan',$id)->first();
    	$edit->nama_layanan = $data['nama'];

        if($edit->save()){
            $data->session()->flash('alert-success', 'Layanan berhasil diperbarui.');
            return redirect('/layanan');
        }
        else{
            $data->session()->flash('alert-danger', 'Layanan gagal diperbarui.');
            return redirect('/layanan');
        }
    }

    public function delete(Request $data, $id)
    {
    	$del = layanan::find($id);
    	if($del->delete())
        {
            $data->session()->flash('alert-success', 'Layanan berhasil dihapus.');
            return redirect ('/layanan');
        }
        else{
            $data->session()->flash('alert-danger', 'Layanan gagal dihapus.');
            return redirect ('/layanan');
        }
        
    }
}