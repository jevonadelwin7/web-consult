<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Consult_room;
use App\Models\Consult_message;
use App\Models\sk_bebas_temuan;
use App\Models\sk_bebas_temuan_detail;
use App\Models\sk_hukuman_disiplin;
use App\Models\Surat_bebas_temuan;
use App\Models\sk_hukuman_disiplin_detail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Pengaduan;
use App\Models\Pengaduan_message;



use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified','checkUserLevel']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->name;
        //$mail = Auth::user()->email;
        $data = [
            'user'=> $user,
            
        ];
        return view('contentUser.dashboard',$data);
    }
    public function konsultasi()
    {
        $userID = Auth::user()->id;
        $consult = Consult_room::where('id_user',$userID)->paginate(5);
        $user = Auth::user()->name;
        $data = [
            'user'=> $user,
            'consult'=>$consult
        ];
        return view('contentUser.consult',$data);
    }
    public function konsultasiBaru()
    {
        /* 
        STATUS ROOM KONSULTASI
        0 = Menunggu balasan admmin
        */
        // ambil nilai ID terakhir dari tabel A
        
          //$lastID = Consult_room::orderBy('id', 'desc')->first()->id;
          $lastID = optional(Consult_room::orderBy('id', 'desc')->first())->id;

        // tambahkan 1 pada nilai ID terakhir dan konversi ke string
        $nextID = (string) ($lastID + 1);

        // tambahkan angka 0 pada depan ID hingga panjangnya 2
        $nextID = str_pad($nextID, 2, '0', STR_PAD_LEFT);
        $dt=Carbon::now();
        $time=$dt->format('Ymdhs');
        // gabungkan awalan 'CI' dengan ID yang sudah diproses
        $customID = 'CI' .$time ; 
        $user = Auth::user()->name;
        $id = Auth::user()->id;
        $userData = User::where('id',$id)->get();
        $data = [
            'user'=> $user,
            'userData' => $userData,
            'id_room'=>$customID
        ];
        return view('contentUser.addconsult',$data);
    }
    public function addConsult(Request $request)
    {
        $userID = Auth::user()->id;
        $request->validate(
        [
            'pertanyaan' => 'required',
        ]);
        if($request->file('file') == "") {
            $data = Consult_message::create([
                'UserID' => $userID,
                'room_id' => $request['idroom'],
                'message' => $request['pertanyaan'],
                'status'=> '1'            
            ]);
            $room = Consult_room::create([
                'id_admin'=>'0',
                'id_user'=> $userID,
                'roomID'=> $request['idroom'],
                'status'=>'0',
            ]);
        }else{
            $fileName = time().'.'.$request->file->extension();  
            $request->file->move(public_path().'/adminfrontend/consultfile/', $fileName);
            $now = Carbon::now();
            $timenow = now();
            $data = Consult_message::create([
                'UserID' => $userID,              
                'room_id' => $request['idroom'],
                'message' => $request['pertanyaan'],
                'status'=> '1'            
            ]);
            $userID = Auth::user()->id;
            $room = Consult_room::create([
                'id_admin'=>'0',
                'id_user'=> $userID,
                'roomID'=> $request['idroom'],
                'file_name'=> $fileName,
                'status'=>'0'
            ]);
        }
        if($data && $room){
            //redirect dengan pesan sukses
            return redirect()->route('konsultasi')->with('success','Konsultasi berhasil ditambahkan.');
        }else{
            //redirect dengan pesan error
            return redirect()->back()->with('error');
        
        }
    
    }
    public function konsultasiDetail($roomID)
    {
        /*
        Status Message
        1 = Muncul Di User
        0 = Belum di assign oleh Verifikator
        2 = Menunggu persetujuan Superadmin
        3 = Irban diminta melakukan Perbaikan
        */
        $room = Consult_room::where('roomID',$roomID)->get();
        $user = Auth::user()->name;
        $IDuser = Auth::user()->id;
        $chat = Consult_message::where('room_id',$roomID)->where('status',1)->orderBy('id','asc')->get(); 
        $firstID = Consult_message::where('room_id',$roomID)->orderBy('id','asc')->pluck('UserID')->first();
        $data = [
            'user'=> $user,
            'IDuser'=>$IDuser,
            'chat'=> $chat,
            'room'=>$room,
            'firstID'=>$firstID,


        ];
        return view('contentUser.detailconsult',$data);     
    }
    public function sbt()
    {
        $userID = Auth::user()->id;
        $sk = sk_bebas_temuan::where('id_pemohon',$userID)->paginate(5);
        $user = Auth::user()->name;
        $data = [
            'user'=> $user,
            'sk'=>$sk
        ];
        return view('contentUser.surat_bt',$data);
    }
    public function addsbt($id)
    {
        //$userID = Auth::user()->id;
        $iduser = Auth::user()->id;
        $userData = User::where('id',$iduser)->get();
        $dt = sk_bebas_temuan_detail::where('id',$id)->get();
        $user = Auth::user()->name;
        $sbt = sk_bebas_temuan::where('id',$id)->pluck('status')->first();
        $data = [
            'sbt'=>$sbt,
            'user'=> $user,
            'userData' => $userData,
            'dt'=>$dt
            
        ];
        return view('contentUser.add_surat_bt',$data);
    }
    public function add_sbt_request(Request $request)
    {
        $lastID = sk_bebas_temuan_detail::orderBy('id', 'desc')->get();
        if ($lastID->isEmpty()){
            $lastID = 1;
        }else{
            $lastID = sk_bebas_temuan_detail::orderBy('id', 'desc')->first()->id;
            $lastID =$lastID+1;
        }

        $user = Auth::user()->name;
        $IDuser = Auth::user()->id;
        $request->validate(
        [
            'tujuan' => 'required',
            
        ]);
        $now = Carbon::now();
        $timenow = now();
        $sbt = sk_bebas_temuan::create([
            'no_surat' => '',
            'id_pemohon' => $IDuser,
            'pemohon' => $user,
            'tujuan' => $request['tujuan'],
            'status'=> '0',
            'file_name'=> '0',

        ]);
        $sbt = sk_bebas_temuan_detail::create([
            'id_pemohon' => $IDuser,
            'id_permohonan' => $lastID,
        ]);
        if($sbt){
            
            return redirect('/layanan_administrasi/surat_bebas_temuan_pemeriksaan')->with('success','Permohonan Berhasil Dibuat');
        }else{
            //redirect dengan pesan error
            //return redirect()->route('sbt')->with('error');
            
            return redirect('/layanan_administrasi/surat_bebas_temuan_pemeriksaan')->with('error');
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'sk_pangkat' => 'nullable|mimes:pdf|max:2048',
            'sk_bebas_asset' => 'nullable|mimes:pdf|max:2048',
            'sp_hukuman_disiplin'=> 'nullable|mimes:pdf|max:2048',
            'sk_bebas_ikatan_dinas'=> 'nullable|mimes:pdf|max:2048',
            'sk_bebas_utang'=> 'nullable|mimes:pdf|max:2048',
        ]);

        $dt = sk_bebas_temuan_detail::where('id_permohonan',$request['id_permohonan']);
        
        if($request->hasFile('sk_pangkat')) {
            $file = $request->file('sk_pangkat');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/sbt_file'), $filename);
            $dt->sk_pangkat = $filename;
            $dat = sk_bebas_temuan_detail::findOrFail($request['id']);
        
                if ($dat->sk_pangkat != null) {
                    file::delete(public_path('adminfrontend/sbt_file/' . $dat->sk_pangkat));
                    
                }
            $dt->update([
                'sk_pangkat'=> $filename
            ]);
        }

        if($request->hasFile('sk_bebas_asset')) {
            $file = $request->file('sk_bebas_asset');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/sbt_file'), $filename);
            $dt->sk_bebas_asset = $filename;
            $dat = sk_bebas_temuan_detail::findOrFail($request['id']);
        
                if ($dat->sk_bebas_asset != null) {
                    file::delete(public_path('adminfrontend/sbt_file/' . $dat->sk_bebas_asset));
                    
                }
            $dt->update([
                'sk_bebas_asset'=> $filename
            ]);
        }

        if($request->hasFile('sk_bebas_utang')) {
            $file = $request->file('sk_bebas_utang');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/sbt_file'), $filename);
            $dt->sk_bebas_utang = $filename;
            $dat = sk_bebas_temuan_detail::findOrFail($request['id']);
        
                if ($dat->sk_bebas_utang != null) {
                    file::delete(public_path('adminfrontend/sbt_file/' . $dat->sk_bebas_utang));
                    
                }
            $dt->update([
                'sk_bebas_utang'=> $filename
            ]);
        }

        if($request->hasFile('sk_bebas_ikatan_dinas')) {
            $file = $request->file('sk_bebas_ikatan_dinas');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/sbt_file'), $filename);
            $dt->sk_bebas_ikatan_dinas = $filename;
            $dat = sk_bebas_temuan_detail::findOrFail($request['id']);
        
                if ($dat->sk_bebas_ikatan_dinas != null) {
                    file::delete(public_path('adminfrontend/sbt_file/' . $dat->sk_bebas_ikatan_dinas));
                    
                }
            $dt->update([
                'sk_bebas_ikatan_dinas'=> $filename
            ]);
        }

        if($request->hasFile('sp_hukuman_disiplin')) {
            $file = $request->file('sp_hukuman_disiplin');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/sbt_file'), $filename);
            $dt->sp_hukuman_disiplin = $filename;
            $dat = sk_bebas_temuan_detail::findOrFail($request['id']);
        
                if ($dat->sp_hukuman_disiplin != null) {
                    file::delete(public_path('adminfrontend/sbt_file/' . $dat->sp_hukuman_disiplin));
                    
                }
            $dt->update([
                'sp_hukuman_disiplin'=> $filename
            ]);
        }


        if ($dt){
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        }else{
            return redirect()->back()->with('error');
        }
    }   

    public function storeSKTP(Request $request)
    {
        $this->validate($request, [
            'sk_pangkat' => 'nullable|mimes:pdf|max:2048',
            'sp_hukuman_disiplin'=> 'nullable|mimes:pdf|max:2048',

        ]);
        $dt = sk_hukuman_disiplin_detail::where('id_permohonan',$request['id_permohonan']);
        
        if($request->hasFile('sk_pangkat')) {
            $file = $request->file('sk_pangkat');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/sbt_file'), $filename);
            $dt->sk_pangkat = $filename;
            $dat = sk_hukuman_disiplin_detail::findOrFail($request['id']);
        
                if ($dat->sk_pangkat != null) {
                    file::delete(public_path('adminfrontend/sbt_file/' . $dat->sk_pangkat));
                    
                }
            $dt->update([
                'sk_pangkat'=> $filename
            ]);
        }
        if($request->hasFile('sp_hukuman_disiplin')) {
            $file = $request->file('sp_hukuman_disiplin');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/sbt_file'), $filename);
            $dt->sp_hukuman_disiplin = $filename;
            $dat = sk_hukuman_disiplin_detail::findOrFail($request['id']);
        
                if ($dat->sp_hukuman_disiplin != null) {
                    file::delete(public_path('adminfrontend/sbt_file/' . $dat->sp_hukuman_disiplin));
                    
                }
            $dt->update([
                'sp_hukuman_disiplin'=> $filename
            ]);
        }


        if ($dt){
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        }else{
            return redirect()->back()->with('error');
        }
    }   

    public function is_upload(Request $request)
    {
        $dt = sk_bebas_temuan_detail::where('id_permohonan', $request['id_permohonan']);
        $da = sk_bebas_temuan::where('id', $request['id_permohonan']);
        $success = true;
        try {
            $dt->update([
                'is_upload' => '1'
            ]);
            $da->update([
                'status' => '1'
            ]);
        } catch (\Exception $e) {
            $success = false;
        }
        if ($success) {
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error');
        }
    }
    public function is_upload_sktp(Request $request)
    {
        $dt = sk_hukuman_disiplin_detail::where('id_permohonan', $request['id_permohonan']);
        $da = sk_hukuman_disiplin::where('id', $request['id_permohonan']);
        $success = true;
        try {
            $dt->update([
                'is_upload' => '1'
            ]);
            $da->update([
                'status' => '1'
            ]);
        } catch (\Exception $e) {
            $success = false;
        }
        if ($success) {
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error');
        }
    }
    public function sktp()
    {
        $userID = Auth::user()->id;
        $sk = sk_hukuman_disiplin::where('id_pemohon',$userID)->paginate(5);
        $user = Auth::user()->name;
        $data = [
            'user'=> $user,
            'sk'=>$sk
        ];
        return view('contentUser.surat_khd',$data);
    }
    public function addsktp($id)
    {
        //$userID = Auth::user()->id;
        $iduser = Auth::user()->id;
        $userData = User::where('id',$iduser)->get();
        $dt = sk_hukuman_disiplin_detail::where('id',$id)->get();
        $user = Auth::user()->name;
        $sktp = sk_hukuman_disiplin::where('id',$id)->pluck('status')->first();
        $data = [
            'sbt'=>$sktp,
            'user'=> $user,
            'userData' => $userData,
            'dt'=>$dt
        ];
        return view('contentUser.add_surat_khd',$data);
    }
    public function template_sbt($id)
    {
        $surat = Surat_bebas_temuan::where('id',$id)->get();
        $tipe = Surat_bebas_temuan::where('id',$id)->pluck('tipe')->first();
        $data = [
            'surat'=>$surat


        ];
        if($tipe == 'sbt'){
            return view('contentUser.template_sbt',$data);
        }
        else  
        {
            return view('contentUser.template_sktp',$data);
        }
           
    }  
    public function add_sktp_request(Request $request)
    {
        $lastID = sk_hukuman_disiplin_detail::orderBy('id', 'desc')->get();
        if ($lastID->isEmpty()){
            $lastID = 1;
        }else{
            $lastID = sk_hukuman_disiplin_detail::orderBy('id', 'desc')->first()->id;
            $lastID =$lastID+1;
        }

        $user = Auth::user()->name;
        $IDuser = Auth::user()->id;
        $request->validate(
        [
            'tujuan' => 'required',
            
        ]);
        $now = Carbon::now();
        $timenow = now();
        $sbt = sk_hukuman_disiplin::create([
            'no_surat' => '',
            'id_pemohon' => $IDuser,
            'pemohon' => $user,
            'tujuan' => $request['tujuan'],
            'status'=> '0',
            'file_name'=> '0',

        ]);
        $sbt = sk_hukuman_disiplin_detail::create([
            'id_pemohon' => $IDuser,
            'id_permohonan' => $lastID,
        ]);
        if($sbt){
            
            return redirect('/layanan_administrasi/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin')->with('success','Permohonan Berhasil Dibuat');
        }else{
            //redirect dengan pesan error
            //return redirect()->route('sbt')->with('error');
            
            return redirect('/layanan_administrasi/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin')->with('error');
        }
    }

    public function addpengaduan()
    {
        /* 
        STATUS ROOM KONSULTASI
        0 = Menunggu balasan admmin
        */
        // ambil nilai ID terakhir dari tabel A
        
          //$lastID = Consult_room::orderBy('id', 'desc')->first()->id;
        $lastID = optional(Consult_room::orderBy('id', 'desc')->first())->id;

        // tambahkan 1 pada nilai ID terakhir dan konversi ke string
        $nextID = (string) ($lastID + 1);

        // tambahkan angka 0 pada depan ID hingga panjangnya 2
        $nextID = str_pad($nextID, 2, '0', STR_PAD_LEFT);
        $dt=Carbon::now();
        $time=$dt->format('Ymdhs');
        // gabungkan awalan 'CI' dengan ID yang sudah diproses
        $customID = 'AD' .$time ; 
        $user = Auth::user()->name;
        $id = Auth::user()->id;
        $userData = User::where('id',$id)->get();
        $data = [
            'user'=> $user,
            'userData' => $userData,
            'id_room'=>$customID
        ];
        return view('contentUser.pengaduan_baru',$data);
    }
    public function pengaduan()
    {
        $userID = Auth::user()->id;
        $pengaduan = Pengaduan::where('id_user',$userID)->paginate(5);
        $user = Auth::user()->name;
        $data = [
            'user'=> $user,
            'aduan'=>$pengaduan
        ];
        return view('contentUser.pengaduan',$data);
    }
    public function add_aduan(Request $request)
    {
        $userID = Auth::user()->id;
        $request->validate(
        [
            'nama_terlapor'  => 'required',
            'jabatan_pekerjaan' => 'required',
            'alamat' => 'required',
            'tempat_kejadian' => 'required',
            'waktu_kejadian' => 'required',
            'uraian' => 'required'
        ]);
        if($request->file('aduan_file') == "") {
            $data = Pengaduan_message::create([
                'UserID' => $userID,
                'room_id' => $request['idroom'],
                'nama_terlapor'  => $request['nama_terlapor'],
                'jabatan_pekerjaan' => $request['jabatan_pekerjaan'],
                'alamat' => $request['alamat'],
                'tempat_kejadian' => $request['tempat_kejadian'],
                'waktu_kejadian' => $request['waktu_kejadian'],
                'uraian' => $request['uraian'],
                'status'=> '1'            
            ]);
            $room = Pengaduan::create([
                'id_admin'=>'0',
                'id_user'=> $userID,
                'roomID'=> $request['idroom'],
                'status'=>'0',
            ]);
        }else{
            $fileName = time().'.'.$request->aduan_file->extension();  
            $request->aduan_file->move(public_path().'/adminfrontend/aduanfile/', $fileName);
            $now = Carbon::now();
            $timenow = now();
            $data = Pengaduan_message::create([
                'UserID' => $userID,              
                'room_id' => $request['idroom'],
                'message' => $request['pertanyaan'],
                'nama_terlapor'  => $request['nama_terlapor'],
                'jabatan_pekerjaan' => $request['jabatan_pekerjaan'],
                'alamat' => $request['alamat'],
                'tempat_kejadian' => $request['tempat_kejadian'],
                'waktu_kejadian' => $request['waktu_kejadian'],
                'uraian' => $request['uraian'],
                'aduan_file'=> $fileName,
                'status'=> '1'            
            ]);
            $userID = Auth::user()->id;
            $room = Pengaduan::create([
                'id_admin'=>'0',
                'id_user'=> $userID,
                'roomID'=> $request['idroom'],
                'status'=>'0'
            ]);
        }
        if($data && $room){
            //redirect dengan pesan sukses
            return redirect()->route('pengaduan')->with('success','Aduan berhasil ditambahkan.');
        }else{
            //redirect dengan pesan error
            return redirect()->back()->with('error');
        
        }
    
    }
    public function pengaduan_detail($roomID)
    {
        /*
        Status Message
        1 = Muncul Di User
        0 = Belum di assign oleh Verifikator
        2 = Menunggu persetujuan Superadmin
        3 = Irban diminta melakukan Perbaikan
        */
        $room = Pengaduan::where('roomID',$roomID)->get();
        $user = Auth::user()->name;
        $IDuser = Auth::user()->id;
        $chat = Pengaduan_message::where('room_id',$roomID)->where('status',1)->orderBy('id','asc')->get(); 
        $firstID = Pengaduan_message::where('room_id',$roomID)->orderBy('id','asc')->pluck('UserID')->first();
        $data = [
            'user'=> $user,
            'IDuser'=>$IDuser,
            'chat'=> $chat,
            'room'=>$room,
            'firstID'=>$firstID,
        ];
        return view('contentUser.pengaduan_detail',$data);     
    }
    
    
    
}
