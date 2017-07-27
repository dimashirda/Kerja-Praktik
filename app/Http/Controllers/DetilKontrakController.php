<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Account_manager;
use App\Anak_perusahaan;
use App\Detil_kontrak;
use App\Pelanggan;
use App\layanan_kontrak;
use App\Layanan;
//use Request;
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
    public function index()
    {   
        $dk = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                ->get();
                return $this->render($dk);
    }
    public function create()
    {   
        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $am = DB::table('Account_managers')->select('id_am','nama_am')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();
        $lyn = DB::table('Layanans')->select('id_layanan','nama_layanan')->get();
    	return view('upload',['ap'=>$ap, 'am'=>$am, 'plg'=>$plg, 'lyn'=>$lyn]);

    }
    public function store(Request $request)
    {   
        //dd($request);
        $detil = new Detil_kontrak;
        //$detil->id_detil = $request->input('id');
        $detil->judul_kontrak = $request->input('nama');
        $detil->id_am = $request->input('id_am');
        $detil->nipnas = $request->input('nipnas');
        $detil->id_perusahaan = $request->input('id_perusahaan');
        $detil->tgl_mulai = $request->input('tgl_mulai');
        $detil->tgl_selesai = $request->input('tgl_selesai');
        $detil->slg = $request->input('slg');
        $depan = $request->input('nama');
        //$depan .=".pdf";
        //dd($depan);
        $file = array('image' => Input::file('image'));
          //dd($file);
          // setting up rules
          $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
          // doing the validation, passing post data, rules and the messages
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
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
                //dd($fileName);
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                $detil->nama_dokumen = $depan; 
                Session::flash('success', 'Upload successfully'); 
                //return Redirect::to('/kontrak');
              }
              else
              {
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('/home');
              }
            }
            else {
              // sending back with error message.
              Session::flash('error', 'uploaded file is not valid');
              return Redirect::to('/home');
            }
          }
        $lyn = $request->input('name');
        $a = count($lyn);
        $detil->save();
        //dd($lyn);
        $i = 0;
        for($i=0;$i<$a;$i++)
        {   
            $lk = new layanan_kontrak;
            $lk->id_detil = $detil->id_detil;
            $lk->id_layanan = $lyn[$i];
            $lk->save();
        }
        //dd($lk);
        return redirect('/home');
    }
    public function download(Request $request)
    {
        $name = $request->nama_dokumen;
        $data = DB::table('Detil_kontraks')
                ->where('nama_dokumen','=',$name)->first();
        $file_path = public_path('uploads').'/'.$name.'.pdf';
        //dd($file_path);
        if(file_exists($file_path)){
            return response()->download($file_path);
        }
        else{
            exit("file tidak tersedia");
        }
    }
    public function delete($id_detil)
    {
        $del = Detil_kontrak::find($id_detil);
        //dd($del);
        $del->delete();
        return redirect ('/kontrak');
    }
    public function search(Request $request)
    {
        $kategori = $request->input('kategori');
        $search1 = $request->input('search1');
        $search2 = $request->input('search2');
        if ($kategori == 'ap') {

                $query = Anak_perusahaan::select('id_perusahaan')
                        ->where('nama_perusahaan','like','%'.$search1.'%')
                        ->get();
                //dd($query);
                $final = array();
                foreach($query as $tmp){
                    $id = $tmp->id_perusahaan;
                    /*$hasil = DB::table('Detil_kontraks')
                            ->select('*')
                            ->where('id_perusahaan','=',$id)->get();
                    */
                    $hasil = Detil_kontrak::select('*')
                            ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                            ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                            ->where('id_perusahaan','=',$id)
                            ->get();
                    foreach ($hasil as $h) {
                        array_push($final,$h);
                    }
                    //array_push($final,$hasil);
                    //$->all();   
                }
                //dd($final);
                return $this->render($final);
                 
        }
        else if ($kategori == 'nama') {
            $hasil = DB::table('Detil_kontraks')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                    ->where('judul_kontrak','like','%'.$search1.'%')
                    ->get();
            return $this->render($hasil);
        }
        else if ($kategori == 'am'){
            $query = DB::table('Account_managers')
                ->where('nama_am','like','%'.$search1.'%')
                ->get();
            $final = array();
                foreach($query as $tmp){
                    $id = $tmp->id_am;
                    /*$hasil = DB::table('Detil_kontraks')
                            ->select('*')
                            ->where('id_perusahaan','=',$id)->get();
                    */
                    $hasil = Detil_kontrak::select('*')
                            ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                                'Anak_perusahaans.id_perusahaan')
                            ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                            ->where('id_am','=',$id)
                            ->get();
                    foreach ($hasil as $h) {
                        array_push($final,$h);
                    }
                    //array_push($final,$hasil);
                    //$->all();   
                }
                //dd($final);
                return $this->render($final);
        }
        else{
            $query = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                ->where('tgl_selesai','<=',$search2)
                ->get();
            //dd($query);
            return $this->render($query);
        }
  }
    public function render($value)
    {   
        $dk = $value;
        $dt = DB::table('layanan_kontraks')
                ->join('Layanans','Layanans.id_layanan','=','layanan_kontraks.id_layanan')
                ->join('Detil_kontraks','layanan_kontraks.id_detil','=','Detil_kontraks.id_detil')
                ->get();        
        $pluckacc = Account_manager::pluck('id_am','nama_am'); 
        $pluckplg = Pelanggan::pluck('nipnas','nama_pelanggan');
        $pluckap = Anak_perusahaan::pluck('id_perusahaan','nama_perusahaan');
        $pluckly = layanan::pluck('id_layanan','nama_layanan');
        $hijau = date('Y-m-d',strtotime("+90 days"));
        $kuning = date('Y-m-d',strtotime("+60 days"));
        $merah = date('Y-m-d',strtotime("+30 days"));
        return view('home',['hijau'=>$hijau, 'kuning'=>$kuning, 'merah'=>$merah, 'dk'=>$dk, 'dt'=>$dt]);
    }
    public function notif()
    {
        $datenow = date('Y-m-d');
        $date = date('Y-m-d', strtotime("+30 days"));
        //dd($date);
         $notif = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
                ->get();
        return $this->render($notif);
//        dd($query);
    }
}
