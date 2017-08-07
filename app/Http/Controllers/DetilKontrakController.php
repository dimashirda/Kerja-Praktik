<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Account_manager;
use App\Anak_perusahaan;
use App\Detil_kontrak;
use App\Pelanggan;
use App\layanan_kontrak;
use App\Layanan;
use App\Notifikasi;
use App\Http\Controllers\NotifikasiController;
use Validator;
use Redirect;
use Input; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Session;
use DB;

class DetilKontrakController extends Controller
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
/*        $dk = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                ->orderBy(DB::raw('LENGTH(Detil_kontraks.nipnas), Detil_kontraks.nipnas'))
                ->get();*/
        $dk = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
            pelanggans.nama_pelanggan, 
            anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
            Account_managers.id_am, Account_managers.nama_am 
            FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
            WHERE detil_kontraks.nipnas = pelanggans.nipnas
            AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
            AND detil_kontraks.id_am = Account_managers.id_am
            ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");

        return $this->render($dk);
    }

    public function create()
    {   
        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $am = DB::table('Account_managers')->select('id_am','nama_am')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();
        $lyn = DB::table('Layanans')->select('id_layanan','nama_layanan')->get();
    	return view('upload',['ap'=>$ap, 'am'=>$am, 'plg'=>$plg, 'lyn'=>$lyn, 'allNotif'=>$this->allNotif]);

    }

    public function store(Request $request)
    {   
        $detil = new Detil_kontrak;
        $detil->judul_kontrak = $request->input('nama');
        $detil->id_am = $request->input('id_am');
        $detil->nipnas = $request->input('nipnas');
        $detil->id_perusahaan = $request->input('id_perusahaan');
        $detil->tgl_mulai = $request->input('tgl_mulai');
        $detil->tgl_selesai = $request->input('tgl_selesai');
        $detil->slg = $request->input('slg');
        $depan = $request->input('nama').'_'.$request->input('tgl_mulai').'_'.$request->input('tgl_selesai');
        $file = array('image' => Input::file('image'));
        
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            $request->session()->flash('alert-danger', 'Data kontrak gagal ditambahkan. File yang diunggah tidak sesuai.');
            // send back to the page with the input data and errors
            return Redirect::to('upload')->withInput()->withErrors($validator);
        }
        else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                if($extension == "pdf")
                {
                    $fileName = $depan.'.'.$extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    
                    // sending back with message
                    $detil->nama_dokumen = $depan;
                }
                else
                {
                    $request->session()->flash('alert-danger', 'Data kontrak gagal ditambahkan. File yang diunggah tidak sesuai.');
                    return redirect('/upload');
                }
            }
            else {
                // sending back with error message.
                $request->session()->flash('alert-danger', 'Data kontrak gagal ditambahkan. File yang diunggah tidak sesuai.');
                return redirect('/upload');
            }
        }
        
        $lyn = $request->input('name');
        $a = count($lyn);
        if($detil->save()){
            echo "masuk";
            $i = 0;
            for($i=0;$i<$a;$i++)
            {   
                $lk = new layanan_kontrak;
                $lk->id_detil = $detil->id_detil;
                $lk->id_layanan = $lyn[$i];
                $lk->save();
            }
        
            $request->session()->flash('alert-success', 'Data kontrak telah ditambahkan');
            return redirect('/upload');
        }
        else{
            $request->session()->flash('alert-danger', 'Data kontrak gagal ditambahkan');
            return redirect('/upload');
        }
    }

    public function download(Request $request)
    {
        $name = $request->nama_dokumen;
        $data = DB::table('Detil_kontraks')
                ->where('nama_dokumen','=',$name)->first();
        $file_path = public_path('uploads').'/'.$name.'.pdf';
        
        if(file_exists($file_path)){
            return response()->download($file_path);
        }
        else{
            $request->session()->flash('alert-danger', 'File tidak tersedia');
            return redirect('/home');
        }
    }
    public function delete(Request $data, $id_detil)
    {
        $del = Detil_kontrak::find($id_detil);
       
        if($del->delete())
        {
            $data->session()->flash('alert-success', 'Data kontrak berhasil dihapus.');
            return redirect ('/home');
        }
        else{
            $request->session()->flash('alert-danger', 'Data kontrak gagal dihapus.');
            return redirect('/home');
        }        
    }

    public function search(Request $request)
    {
        $kategori = $request->input('kategori');
        $search1 = $request->input('search1');
        $search2 = $request->input('search2');
        $search3 = $request->input('search3');
        if ($kategori == 'ap') {
/*            $final = Detil_kontrak::select('*')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=','Anak_perusahaans.id_perusahaan')
                    ->where('nama_perusahaan','like','%'.$search1.'%')
                    ->get();*/
            $final = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND anak_perusahaans.nama_perusahaan LIKE '%".$search1."%'
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");                    
            return $this->render($final);
        }

        else if ($kategori == 'nama') {
            /*$hasil = DB::table('Detil_kontraks')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                    ->where('judul_kontrak','like','%'.$search1.'%')
                    ->get();*/
            $hasil = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND detil_kontraks.judul_kontrak LIKE '%".$search1."%'
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");

            return $this->render($hasil);
        }

        else if ($kategori == 'am'){
/*            $final = Detil_kontrak::select('*')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                                'Anak_perusahaans.id_perusahaan')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->where('nama_am','like','%'.$search1.'%')
                    ->get();*/
            $final = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND Account_managers.nama_am LIKE '%".$search1."%'
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");
                    
            return $this->render($final);
        }

        else if($kategori == 'pelanggan'){
            /*$final = Detil_kontrak::select('*')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                                'Anak_perusahaans.id_perusahaan')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->where('nama_pelanggan','like','%'.$search1.'%')
                    ->get();*/
            $final = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND Pelanggans.nama_pelanggan LIKE '%".$search1."%'
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");
                    
            return $this->render($final);
        }

        else if($kategori=='nipnas'){
            /*$final = Detil_kontrak::select('*')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->where('Detil_kontraks.nipnas','like','%'.$search1.'%')
                    ->get();*/
             $final = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND Pelanggans.nipnas LIKE '%".$search1."%'
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");   
            return $this->render($final);

        }
        else if($kategori=='tgl_akhir') {
            $tanggal = date("Y-m-d", strtotime($search2));
            /*$query = DB::table('Detil_kontraks')
                ->join('Account_managers', 'Detil_kontraks.id_am', '=', 'Account_managers.id_am')
                ->join('Pelanggans', 'Detil_kontraks.nipnas', '=', 'Pelanggans.nipnas')
                ->join('Anak_perusahaans', 'Detil_kontraks.id_perusahaan', '=',
                    'Anak_perusahaans.id_perusahaan')
                ->where('Detil_kontraks.tgl_selesai', '<=', $tanggal)
                ->get();*/
            $query = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND detil_kontraks.tgl_selesai <= '".$tanggal."'
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");
        }
        else if($kategori=='status') {
            if($search3=='satu') {
                //$datenow = date('Y-m-d');
                $date = date('Y-m-d', strtotime("+30 days"));
                /*$query = DB::table('Detil_kontraks')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                    ->where('Detil_kontraks.tgl_selesai','<=',$date)
                    ->get();*/
                $query = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND detil_kontraks.tgl_selesai <= '".$date."'
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");
            }
            else if ($search3=='dua') {
                $datenow = date('Y-m-d',strtotime("+31 days"));
                $date = date('Y-m-d', strtotime("+60 days"));

                /*$query = DB::table('Detil_kontraks')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                    ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
                    ->get();*/
                $query = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND (detil_kontraks.tgl_selesai BETWEEN '".$datenow."' AND '".$date."')
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");
            }
            else if ($search3=='tiga') {
                $datenow = date('Y-m-d',strtotime("+61 days"));
                $date = date('Y-m-d', strtotime("+90 days"));
                /*$query = DB::table('Detil_kontraks')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                    ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
                    ->get();*/
                $query = DB::select("SELECT detil_kontraks.*, pelanggans.nipnas, 
                    pelanggans.nama_pelanggan, 
                    anak_perusahaans.id_perusahaan, anak_perusahaans.nama_perusahaan,
                    Account_managers.id_am, Account_managers.nama_am 
                    FROM detil_kontraks, pelanggans, anak_perusahaans, Account_managers
                    WHERE detil_kontraks.nipnas = pelanggans.nipnas
                    AND detil_kontraks.id_perusahaan = anak_perusahaans.id_perusahaan
                    AND detil_kontraks.id_am = Account_managers.id_am
                    AND (detil_kontraks.tgl_selesai BETWEEN '".$datenow."' AND '".$date."')
                    ORDER BY LENGTH(Detil_kontraks.nipnas) ASC");
            }
        }
            return $this->render($query);

    }

    /*public function hijau()
    {
        $datenow = date('Y-m-d',strtotime("+61 days"));
        $date = date('Y-m-d', strtotime("+90 days"));
        $dk = DB::table('Detil_kontraks')
            ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
            ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
            ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                'Anak_perusahaans.id_perusahaan')
            ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
            ->get();
        return $this->render($dk);
    }

    public function kuning()
    {
        $datenow = date('Y-m-d',strtotime("+31 days"));
        $date = date('Y-m-d', strtotime("+60 days"));

        $dk = DB::table('Detil_kontraks')
            ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
            ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
            ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                'Anak_perusahaans.id_perusahaan')
            ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
            ->get();
        return $this->render($dk);
    }

    public function merah()
    {
        $datenow = date('Y-m-d');
        $date = date('Y-m-d', strtotime("+30 days"));
        $dk = DB::table('Detil_kontraks')
            ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
            ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
            ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                'Anak_perusahaans.id_perusahaan')
            ->where('Detil_kontraks.tgl_selesai','<=',$date)
            ->get();
        return $this->render($dk);
    }*/

    public function render($value)
    {   
        $dk = $value;
        /*$notif = DB::table('Notifikasis')
                ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
                ->where('Notifikasis.flag','=','0')
                ->get();*/
        /*$dt = DB::table('layanan_kontraks')
                ->join('Layanans','Layanans.id_layanan','=','layanan_kontraks.id_layanan')
                ->join('Detil_kontraks','layanan_kontraks.id_detil','=','Detil_kontraks.id_detil')
                ->get();*/
        $dt = DB::select("SELECT layanan_kontraks.id_layanan_kontrak, 
                layanans.id_layanan, layanans.nama_layanan,
                Detil_kontraks.id_detil 
                FROM layanan_kontraks, layanans, detil_kontraks 
                WHERE detil_kontraks.id_detil = layanan_kontraks.id_detil 
                AND layanans.id_layanan = layanan_kontraks.id_layanan");       
        /*$pluckacc = Account_manager::pluck('id_am','nama_am'); 
        $pluckplg = Pelanggan::pluck('nipnas','nama_pelanggan');
        $pluckap = Anak_perusahaan::pluck('id_perusahaan','nama_perusahaan');
        $pluckly = layanan::pluck('id_layanan','nama_layanan');
        */
        $merah = date('Y-m-d',strtotime("+30 days"));
        $kuning = date('Y-m-d',strtotime("+60 days"));
        $hijau = date('Y-m-d',strtotime("+90 days"));        
        return view('home',['merah'=>$merah, 'kuning'=>$kuning, 'hijau'=>$hijau,
            'dk'=>$dk, 'dt'=>$dt, /*'notif'=>$notif,*/ 'allNotif'=>$this->allNotif]);
    }

    /*public function notif()
    {
        $datenow = date('Y-m-d');
        $date = date('Y-m-d', strtotime("+30 days"));
        $notif = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
                ->get();
        return $this->render($notif);
    }*/

    public function edit($id_detil)
    {
        $dk = DB::table('Detil_kontraks')
            ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
            ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
            ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                'Anak_perusahaans.id_perusahaan')
            ->where('Detil_kontraks.id_detil','=',$id_detil)
            ->get();
        $dt = DB::table('layanan_kontraks')
            ->join('Layanans','Layanans.id_layanan','=','layanan_kontraks.id_layanan')
            ->join('Detil_kontraks','layanan_kontraks.id_detil','=','Detil_kontraks.id_detil')
            ->where('Detil_kontraks.id_detil','=',$id_detil)
            ->get();

        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $am = DB::table('Account_managers')->select('id_am','nama_am')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();
        $lyn = DB::table('Layanans')->select('id_layanan','nama_layanan')->get();
        return view('detil_kontrak.edit',['dk'=>$dk,'am'=>$am, 'plg'=>$plg, 'ap'=>$ap,'lyn'=>$lyn, 'dt'=>$dt, 'allNotif'=>$this->allNotif]);
    }

    public function save(Request $request)
    {
        $detil = Detil_kontrak::where('id_detil',$request['id'])->first();

        if (isset($request['image'])) {
            $detil->id_detil = $request['id'];
            $detil->judul_kontrak = $request['nama'];
            $detil->id_am = $request['id_am'];
            $detil->nipnas = $request['nipnas'];
            $detil->id_perusahaan = $request['id_perusahaan'];
            $detil->tgl_mulai = $request['tgl_mulai'];
            $detil->tgl_selesai = $request['tgl_selesai'];
            $detil->slg = $request['slg'];
            $depan = $request['nama'];
            $file = array('image' => Input::file('image'));
    
            $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
            
            // doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                $request->session()->flash('alert-danger', 'Data kontrak gagal diperbarui. File yang diunggah tidak sesuai.');
                return Redirect::to('kontrak/edit/'.$request['id'])->withInput()->withErrors($validator);
            }
            else {
                // checking file is valid.
                if (Input::file('image')->isValid()) {
                    $destinationPath = 'uploads'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    if ($extension == "pdf") {
                        $fileName = $depan . '.' . $extension; // renameing image
                        
                        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                        
                        // sending back with message
                        $detil->nama_dokumen = $depan;
                    } 
                    else {
                        $request->session()->flash('alert-danger', 'Data kontrak gagal diperbarui. File yang diunggah tidak sesuai.');
                        return redirect('/home');
                    }
                } 
                else {  
                    $request->session()->flash('alert-danger', 'Data kontrak gagal diperbarui. File yang diunggah tidak sesuai.');
                    return redirect('/upload');
                }
            }
            if($detil->save()){
                $request->session()->flash('alert-success', 'Data kontrak berhasil diperbarui.');
                return redirect('home');
            }
            else{
                $request->session()->flash('alert-danger', 'Data kontrak gagal diperbarui.');
                return redirect('/home');
            }
        }
        else {
            $upd = DB::table('detil_kontraks')
                ->where('id_detil', $request['id'])
                ->update(['judul_kontrak' => $request['nama'],
                        'id_am' => $request['id_am'],
                        'nipnas'=> $request['nipnas'],
                        'id_perusahaan' => $request['id_perusahaan'],
                        'tgl_mulai' => $request['tgl_mulai'],
                        'tgl_selesai' => $request['tgl_selesai'],
                        'slg' => $request['slg']]);
            if($upd){
                $request->session()->flash('alert-success', 'Data kontrak berhasil diperbarui.');
                return redirect('home');
            }
            else{
                $request->session()->flash('alert-danger', 'Data kontrak gagal diperbarui.');
                return redirect('/home');
            }
        }

        $lyn = $request->input('name');
        $hapus = $request->input('id');
        $a = count($lyn);

        $i = 0;
        $delete = DB::table('layanan_kontraks')
                    ->where('layanan_kontraks.id_detil','=',$hapus)->delete();

        for($i=0;$i<$a;$i++)
        {
            $lk = new layanan_kontrak;
            $lk->id_detil = $detil->id_detil;
            $lk->id_layanan = $lyn[$i];
            $s = $lk->save();

            if(!($s)){
                $request->session()->flash('alert-danger', 'Data kontrak gagal diperbarui');
                return redirect('/home');
            }
        }
    }
}