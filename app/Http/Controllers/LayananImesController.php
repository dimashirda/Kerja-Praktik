<?php

namespace App\Http\Controllers;

use App\Layanan_imes;
use DB;
use Illuminate\Http\Request;

class LayananImesController extends Controller
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
            $layanan = DB::table('layanan_imes')
            ->where('nama_imes','like','%'.$search.'%')
            ->orderBy('nama_imes')
            ->paginate(25);
        }
        elseif($category == "ID")
        {
            $layanan = DB::table('layanan_imes')
            ->where('id_imes','like','%'.$search.'%')
            ->orderBy('id_imes')
            ->paginate(25);
        }
        elseif($category == "jenis")
        {
            $layanan = DB::table('layanan_imes')
            ->where('flag', 'like', '%'.$search.'%')
            ->orderBy('flag')
            ->paginate(25);
        }
        else
        {
            $layanan = DB::table('layanan_imes')->paginate(25);
        }
        return view('layanan_imes.index',['layanan'=>$layanan, 'allNotif'=>$this->allNotif]);
    }

    public function store(Request $request)
    {
        
        $imes = new Layanan_imes;
        $imes->nama_imes = $request->input('nama');
        $imes->flag = $request->input('flag');

        if($imes->save()){
            $request->session()->flash('alert-success', 'Layanan IMES telah ditambahkan.');
            return redirect('/imes');    
        }
        else{
            $request->session()->flash('alert-danger', 'Layanan IMES gagal ditambahkan.');
            return redirect('/imes');   
        }
    }

    public function save(Request $data, $id)
    {   
        $edit = layanan_imes::where('id_imes',$id)->first();
        $edit->nama_imes = $data['nama'];
        $edit->flag = $data['flag'];

        if($edit->save()){
            $data->session()->flash('alert-success', 'Layanan IMES berhasil diperbarui.');
            return redirect('/imes'); 
        }
        else{
            $data->session()->flash('alert-danger', 'Layanan IMES gagal diperbarui.');
            return redirect('/imes');   
        }        
    }

    public function delete(Request $data, $id)
    {
        $del = layanan_imes::find($id);
        if($del->delete()){
            $data->session()->flash('alert-success', 'Layanan IMES berhasil dihapus.');
            return redirect('/imes');
        }
        else{
            $data->session()->flash('alert-danger', 'Layanan IMES gagal dihapus.');
            return redirect('/imes');
        }
    }
}