<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use DB;

class PelangganController extends Controller
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
            $pelanggan = DB::table('pelanggans')
            ->where('nama_pelanggan','like','%'.$search.'%')
            ->orderBy('nama_pelanggan')
            ->paginate(25);
        }
        elseif($category == "nipnas")
        {
            $pelanggan = DB::table('pelanggans')
            ->where('nipnas','like','%'.$search.'%')
            ->orderBy(DB::raw('LENGTH(nipnas), nipnas'))
            ->paginate(25);
        }
        elseif ($category == "segmen") 
        {
            $pelanggan = DB::table('pelanggans')
            ->where('segmen', 'like', '%'.$search.'%')
            ->orderBy(DB::raw('LENGTH(nipnas), nipnas'))
            ->paginate(25);
        }
        else
        {
            $pelanggan = DB::table('pelanggans')
            ->orderBy(DB::raw('LENGTH(nipnas), nipnas'))
            ->paginate(25);
        }
        return view('pelanggan.index',['pelanggan'=>$pelanggan, 'allNotif'=>$this->allNotif]);
    }

    public function create()
    {
    	return view('pelanggan.create', ['allNotif'=>$this->allNotif]);
    }

    public function store(Request $request)
    {
        $cek = DB::table('pelanggans')->where('nipnas', '=', $request->input('nipnas'));
        if(count($cek)){
            $request->session()->flash('alert-danger', 'Data pelanggan gagal ditambahkan. NIPNAS sudah digunakan.');
            return redirect('/pelanggan/create');
        }
        else{
            $pelanggan = new Pelanggan;
            $pelanggan->nipnas = $request->input('nipnas');
            $pelanggan->nama_pelanggan = $request->input('nama');
            $pelanggan->segmen = $request->input('segmen');
            $pelanggan->tlp_pelanggan = $request->input('tlp');
            $pelanggan->email_pelanggan = $request->input('email');

            if($pelanggan->save()){
                $request->session()->flash('alert-success', 'Data pelanggan telah ditambahkan.');
                return redirect('/pelanggan/create');
            }
            else{
                $request->session()->flash('alert-danger', 'Data pelanggan gagal ditambahkan.');
                return redirect('/pelanggan/create');
            }
        }  
    }

    public function edit($nipnas)
    {
    	$plg = pelanggan::find($nipnas);
    	return view('pelanggan.edit',['pelanggan' => $plg, 'allNotif'=>$this->allNotif]);
    }

    public function save(Request $data, $nipnas)
    {	
        $edit = pelanggan::where('nipnas',$nipnas)->first();

    	$edit->nama_pelanggan = $data['name'];
    	$edit->tlp_pelanggan = $data['tlp'];
    	$edit->email_pelanggan = $data['email'];
    	
        if($edit->save()){
            $data->session()->flash('alert-success', 'Data pelanggan berhasil diubah.');
            return redirect('/pelanggan');
        }
        else{
            $data->session()->flash('alert-danger', 'Data pelanggan gagal diubah.');
            return redirect('/pelanggan');
        }
    }

    public function delete(Request $request, $nipnas)
    {
    	$del = pelanggan::where('nipnas',$nipnas);
        if($del->delete()){
            $request->session()->flash('alert-success', 'Data pelanggan berhasil dihapus.');
            return redirect ('/pelanggan');
        }
        else {
            $request->session()->flash('alert-danger', 'Data pelanggan berhasil dihapus.');
            return redirect ('/pelanggan');
        }
    }
}