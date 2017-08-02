<?php

namespace App\Http\Controllers;

use DB;
use App\Anak_perusahaan;

use Illuminate\Http\Request;

class AnakPerusahaanController extends Controller
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
            $acc = DB::table('anak_perusahaans')
            ->where('nama_perusahaan','like','%'.$search.'%')
            ->orderBy('nama_perusahaan')
            ->paginate(25);
        }
        elseif($category == "ID")
        {
            $acc = DB::table('anak_perusahaans')
            ->where('id_perusahaan','like','%'.$search.'%')
            ->orderBy('id_perusahaan')
            ->paginate(25);
        }
        else
        {
            $acc = DB::table('anak_perusahaans')->paginate(25);
        }
    	return view('anak_perusahaans.index',['acc'=>$acc, 'allNotif'=>$this->allNotif]);
      
    }
    
    public function create()
    {
    	return view('anak_perusahaans.create', ['allNotif'=>$this->allNotif]);
    }
    
    public function store(request $req)
    {
        $cek = DB::table('anak_perusahaans')->where('id_perusahaan', '=', $req->input('id_anakperu'));
        if(count($cek)){
            $req->session()->flash('alert-id', 'Data anak perusahaan gagal ditambahkan. ID Perusahaan sudah digunakan.');
            return redirect ('/perusahaan/create');
        }
        else{
            $a = new Anak_perusahaan();
            $a->id_perusahaan = $req->input('id_anakperu');
            $a->nama_perusahaan = $req->input('nama_anakperu');
            $a->tlp_perusahaan = $req->input('tlp_anakperu');
            $a->email_perusahaan = $req->input('email_anakperu');

            if($a->save()){
                $req->session()->flash('alert-success', 'Data anak perusahaan telah ditambahkan');
                return redirect ('/perusahaan/create');
            }
            else{
                $req->session()->flash('alert-danger', 'Data anak perusahaan gagal ditambahkan');
                return redirect ('/perusahaan/create');
            }
        }
    }
    
    public function edit($id_perusahaan)
    {
    	$plg = Anak_perusahaan::find($id_perusahaan);
    	return view('anak_perusahaans.edit',['anak_perusahaans' => $plg, 'allNotif'=>$this->allNotif]);
    }
    
    public function save(Request $data, $id_perusahaan)
    {	
    	$edit = Anak_perusahaan::where('id_perusahaan',$id_perusahaan)->first();
    	$edit->nama_perusahaan = $data['nama_anakperu'];
    	$edit->tlp_perusahaan = $data['tlp_anakperu'];
    	$edit->email_perusahaan = $data['email_anakperu'];
    	if($edit->save()){
            $data->session()->flash('alert-edit', 'Data anak perusahaan berhasil diubah');
            return redirect('/perusahaan');
        }
        else{
            $data->session()->flash('alert-gagaledit', 'Data anak perusahaan gagal diubah');
            return redirect('/perusahaan');
        }
    }
    
    public function delete(Request $data, $id_perusahaan)
    {
    	$del = Anak_perusahaan::where('id_perusahaan',$id_perusahaan);
    	if($del->delete()){        {
            $data->session()->flash('alert-hapus', 'Data anak perusahaan berhasil dihapus');
            return redirect ('/perusahaan');
        }
        else{
            $data->session()->flash('alert-gagalhapus', 'Data anak perusahaan gagal dihapus');
            return redirect ('/perusahaan');
        }

        
    }
}
