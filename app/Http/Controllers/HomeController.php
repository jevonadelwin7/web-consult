<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Consult_room;
use App\Models\Consult_message;
use App\Models\sk_bebas_temuan;
use App\Models\sk_bebas_temuan_detail;
use App\Models\sk_hukuman_disiplin;
use App\Models\sk_hukuman_disiplin_detail;
use App\Models\Surat_bebas_temuan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pengaduan;
use App\Models\Pengaduan_message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified','admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('');
    }
    public function handleAdmin()
    {
        $user = Auth::user()->name;
        $isAdmin = Auth::user()->is_admin;
        $totUser = User::where('is_admin',0 )->orWhere('is_admin',2)->select('id')->get()->count();
        $totPegawai = User::where('is_admin',0 )->select('id')->get()->count();
        $totMas = User::Where('is_admin',2)->select('id')->get()->count();
        $totConsult=Consult_room::where('status',0 )->select('id')->get()->count();
        $totConsDone=Consult_room::where('status',1 )->select('id')->get()->count();

        $totAduan=Pengaduan::where('status',0 )->select('id')->get()->count();
        $totAduanDone=Pengaduan::where('status',1 )->select('id')->get()->count();

        //surat_bebas_temuan
        $sbtnew= sk_bebas_temuan::where('status',0 )->select('id')->get()->count();
        $sbtprocess= sk_bebas_temuan::whereBetween('status',[1, 4] )->select('id')->get()->count();
        $sbtaccept= sk_bebas_temuan::where('status',5 )->select('id')->get()->count();
        $sbtreject= sk_bebas_temuan::where('status',6 )->select('id')->get()->count();
        //sk_hukuman_disiplin
        $skhdnew= sk_hukuman_disiplin::where('status',0 )->select('id')->get()->count();
        $skhdprocess= sk_hukuman_disiplin::whereBetween('status',[1, 4] )->select('id')->get()->count();
        $skhdccept= sk_hukuman_disiplin::where('status',5 )->select('id')->get()->count();
        $skhdreject= sk_hukuman_disiplin::where('status',6 )->select('id')->get()->count();

        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'totUser'=>$totUser,
            'totPegawai'=>$totPegawai,
            'totMas'=>$totMas,
            'totConsult'=>$totConsult,
            'totConsDone'=>$totConsDone,
            'totAduan'=>$totAduan,
            'totAduanDone'=>$totAduanDone,
            'sbtnew'=>$sbtnew,
            'sbtprocess'=>$sbtprocess,
            'sbtaccept'=>$sbtaccept,
            'sbtreject'=>$sbtreject,
            'skhdnew'=>$skhdnew,
            'skhdprocess'=>$skhdprocess,
            'skhdccept'=>$skhdccept,
            'skhdreject'=>$skhdreject,
        ];
        return view('contentAdmin.dashboard',$data);
    }
    public function profile()
    {
        $user = Auth::user()->name;
        $id = Auth::user()->id;
        $isAdmin = Auth::user()->is_admin;
        $dataUser = Auth::user()->where('id',$id)->first();
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'dataUser'=>$dataUser
        ];
        return view('contentAdmin.profile',$data);
    }
    public function dataAdmin()
    {
        $admin = User::where('is_admin',1)->orWhere('is_admin',3)->orWhere('is_admin',4)->orWhere('is_admin',5)->paginate(5);
        $user = Auth::user()->name;
        $isAdmin = Auth::user()->is_admin;
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'admin'=>$admin
        ];
        return view('contentAdmin.listadmin',$data);     
    }
    public function addAdmin(Request $request)
    {
        $user = Auth::user()->name;
        $request->validate(
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|confirmed',
            'role' => 'required',

        ]);
        $now = Carbon::now();
        $timenow = now();
        $admin = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'is_admin' => $request['role'],
            'email_verified_at'=> '2023-04-26 13:42:39'
        ]);
        if($admin){
            //redirect dengan pesan sukses
            return redirect()->route('dataAdmin');
        }else{
            //redirect dengan pesan error
            return redirect('dataAdmin')->with('error');
        
        }
    }
    public function deleteAdmin($id)
    {
        $admin = User::where('id', $id)->delete();
        return redirect()->back();    
    }
    public function konsultasi()
    {

        $userID = Auth::user()->id;
        $isAdmin = Auth::user()->is_admin;
        if($isAdmin == 4){
            $consult = Consult_room::where('id_admin',$userID)->orderBy('created_at','desc')->paginate(5);
        }else{
            $consult = Consult_room::orderBy('created_at','desc')->paginate(5);
        }

        $user = Auth::user()->name;
        $admin = User::where('is_admin','4')->orWhere('is_admin','1')->get();
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'consult'=>$consult,
            'listAdmin'=>$admin
        ];
        return view('contentAdmin.consult',$data);
    }
    public function update(Request $request, $id)
    {
        $post = Consult_room::find($id);
        $post->id_admin = $request->assign;
        $post->save();
        return redirect()->route('konsultasi')->with('success','Data Berhasil Diupdate');
    }
    public function updateMessage(Request $request, $id)
    {
        // $post = Consult_message::find($id);
        // $post->status = $request->assign;
        // $post->save();
        // return redirect()->back()->with('successs');
        if($request->status === '1'){
            
            DB::transaction(function () use ($request,$id) {
                DB::table('consult_messages')
                ->where('id', $id)
                ->update([
                    'status' => $request->input('status')
                ]);
                DB::table('consult_rooms')
                ->where('roomID',$request->idroom)
                ->update([
                    'status' => '1'
                ]);
            });
            
        }else{
            $msg = Consult_message::findOrFail($request->id);
            $msg->update([
                'status' => $request->input('status')
            ]);
        }
        
        return redirect()->back()->with('successs');
    }
    public function updateComment(Request $request, $id)
    {
        // $post = Consult_message::find($id);
        // $post->status = $request->assign;
        // $post->save();
        // return redirect()->back()->with('successs');
        $msg = Consult_message::findOrFail($request->id);
        $msg->update([
            'message' => $request->input('comment'),
            'status'=>'0'
        ]);
        return redirect()->back()->with('successs');
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
        
        $isadmin = Auth::user()->is_admin;

        //$chat = Consult_message::where('room_id',$roomID)->where('status',1)->orderBy('id','asc')->get();
        $chat = Consult_message::where('room_id',$roomID)->orderBy('id','asc')->get(); 
        $firstID = Consult_message::where('room_id',$roomID)->orderBy('id','asc')->pluck('UserID')->first();
        $DataUser = User::where('id',$firstID)->get();
        // $chat = DB::table('Consult_messages')
        //         ->leftjoin('users','Consult_messages.UserID','=','users.id')
        //         ->where('room_id',$roomID)->orderBy('Consult_messages.id','asc')->get();
        $isAdmin = Auth::user()->is_admin;
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'firstID'=>$firstID,
            'chat'=> $chat,
            'room'=>$room,
            'roomID'=>$roomID,
            'isadmin'=>$isadmin,
            'DataUser'=>$DataUser


        ];
        return view('contentAdmin.detailconsult',$data);     
    }    
    public function addMessage(Request $request)
    {
        $user = Auth::user()->name;
        $userID = Auth::user()->id;
        $now = Carbon::now();
        $timenow = now();
        $request->validate(
            [
                'files' => 'mimes:jpeg,bmp,png,gif,svg,pdf,zip,rar',
    
            ]);
        if ($request->hasFile('files')) {
            
            $file = $request->file('files');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/consultfile'), $filename);

            $data = Consult_message::create([
                'UserID' => $userID,
                'room_id' => $request['idroom'],
                'message' => $request['comment'],
                'status'=> '0',
                'consult_file'=> $filename,
            ]);
        }else{
            $data = Consult_message::create([
                'UserID' => $userID,
                'room_id' => $request['idroom'],
                'message' => $request['comment'],
                'status'=> '0'            
            ]);
        }
        
        if($data){
            //redirect dengan pesan sukses
            return redirect()->back()->with('successs');
        }else{
            //redirect dengan pesan error
            return redirect()->back()->with('error');
        
        }
    }
    public function sbt()
    {
        $userID = Auth::user()->id;
        $sk = sk_bebas_temuan::orderBy('created_at','desc')->paginate(5);
        $user = Auth::user()->name;
        $isAdmin = Auth::user()->is_admin;
        //$surat = Surat_bebas_temuan::where('id_permohonan',$id)->where('id_permohonan_detail',$iddetail)->where('tipe','sbt')->get();            
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'sk'=>$sk
        ];
        return view('contentAdmin.surat_bt',$data);
    }
    public function addsbt($id)
    {
        //$userID = Auth::user()->id;
       // $iduser = Auth::user()->id;
        //$userData = User::where('id',$iduser)->get();
        $dt = sk_bebas_temuan_detail::where('id_permohonan',$id)->get();
        $sbt = sk_bebas_temuan::where('id',$id)->pluck('status')->first();
        $iddetail = sk_bebas_temuan_detail::where('id_permohonan',$id)->pluck('id')->first();   
        $iduser = sk_bebas_temuan_detail::where('id_permohonan',$id)->pluck('id_pemohon')->first();
        $userData = User::where('id',$iduser)->get();
        $user = Auth::user()->name;
        $isAdmin = Auth::user()->is_admin;
        $surat = Surat_bebas_temuan::where('id_permohonan',$id)->where('id_permohonan_detail',$iddetail)->where('tipe','sbt')->get();    
        $suratid = Surat_bebas_temuan::where('id_permohonan',$id)->where('id_permohonan_detail',$iddetail)->where('tipe','sbt')->pluck('id')->first();         
        
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'userData' => $userData,
            'dt'=>$dt,
            'sbt'=>$sbt,
            'surat'=>$surat,
            'suratid'=>$suratid
        ];
        return view('contentAdmin.add_surat_bt',$data);
    }
    public function updateMessageSBT(Request $request, $id)
    {

        // $msg = sk_bebas_temuan_detail::findOrFail($request->id);
        // $msg->update([
        //     'message' => $request->input('comment'),
        // ]);
        DB::transaction(function () use ($request,$id) {
            DB::table('sk_bebas_temuan_details')
            ->where('id', $id)
            ->update([
                'message' => $request->input('comment'),
            ]);
            DB::table('sk_bebas_temuans')
            ->where('id',$request->id_permohonan)
            ->update([
                'status' => $request->status
            ]);
        });
        return redirect()->back()->with('successs');
    }
    public function create_surat_sbt(Request $request)
    {

        $surat = Surat_bebas_temuan::create([
            'id_permohonan_detail'=>$request['id_permohonan_detail'],
            'id_permohonan'=>$request['id_permohonan'],
            'nomor_surat'=>$request['nomor_surat'],
            'nama_pejabat'=>$request['nama_pejabat'],
            'nip_pejabat'=>$request['nip_pejabat'],
            'pang_gol_pejabat'=>$request['pang_gol_pejabat'],
            'jabatan_pejabat'=>$request['jabatan_pejabat'],
            'nama_pemohon'=>$request['nama_pemohon'],
            'nip_pemohon'=>$request['nip_pemohon'],
            'pang_gol_pemohon'=>$request['pang_gol_pemohon'],
            'jabatan_pemohon'=>$request['jabatan_pemohon'],
            'unit_kerja_pemohon'=>$request['unit_kerja_pemohon'],
            'tanggal_surat'=>$request['tanggal_surat'],
            'jabatan_ttd'=>$request['jabatan_ttd'],
            'status'=>0,
            'tipe'=>$request['tipe']
            ]);
            if($surat){
            //redirect dengan pesan sukses
            return redirect()->back()->with('successs');
            }else{
                //redirect dengan pesan error
                return redirect()->back()->with('error');
            
            }
            
    }
    public function updateSbt(Request $request, $id)
    {

        $surat = Surat_bebas_temuan::findOrFail($request->id);
        $surat->update([
            //'id_permohonan_detail'=>$request['id_permohonan_detail'],
            //'id_permohonan'=>$request['id_permohonan'],
            'nomor_surat'=>$request['nomor_surat'],
            'nama_pejabat'=>$request['nama_pejabat'],
            'nip_pejabat'=>$request['nip_pejabat'],
            'pang_gol_pejabat'=>$request['pang_gol_pejabat'],
            'jabatan_pejabat'=>$request['jabatan_pejabat'],
            'nama_pemohon'=>$request['nama_pemohon'],
            'nip_pemohon'=>$request['nip_pemohon'],
            'pang_gol_pemohon'=>$request['pang_gol_pemohon'],
            'jabatan_pemohon'=>$request['jabatan_pemohon'],
            'unit_kerja_pemohon'=>$request['unit_kerja_pemohon'],
            'tanggal_surat'=>$request['tanggal_surat'],
            'jabatan_ttd'=>$request['jabatan_ttd'],
            'status'=>$request['ttd'],
            //'tipe'=>'sbt'
            ]);
            $sbt = sk_bebas_temuan::findorFail($request['id_permohonan']);
            if($request['ttd']=='1'){
                $sbt->update([
                    'file_name'=>$request->id,
                    'status'=>5,
                ]);
            }else{
                $sbt->update([
                    'file_name'=>$request->id,
                    'status'=>4,
                    
                ]);
            }
            
            if($surat && $sbt){
            //redirect dengan pesan sukses
            return redirect()->back()->with('successs');
            }else{
                //redirect dengan pesan error
                return redirect()->back()->with('error');
            
        }
    }
    public function updateSKTP(Request $request, $id)
    {

        $surat = Surat_bebas_temuan::findOrFail($request->id);
        $surat->update([
            //'id_permohonan_detail'=>$request['id_permohonan_detail'],
            //'id_permohonan'=>$request['id_permohonan'],
            'nomor_surat'=>$request['nomor_surat'],
            'nama_pejabat'=>$request['nama_pejabat'],
            'nip_pejabat'=>$request['nip_pejabat'],
            'pang_gol_pejabat'=>$request['pang_gol_pejabat'],
            'jabatan_pejabat'=>$request['jabatan_pejabat'],
            'nama_pemohon'=>$request['nama_pemohon'],
            'nip_pemohon'=>$request['nip_pemohon'],
            'pang_gol_pemohon'=>$request['pang_gol_pemohon'],
            'jabatan_pemohon'=>$request['jabatan_pemohon'],
            'unit_kerja_pemohon'=>$request['unit_kerja_pemohon'],
            'tanggal_surat'=>$request['tanggal_surat'],
            'jabatan_ttd'=>$request['jabatan_ttd'],
            'status'=>$request['ttd'],
            //'tipe'=>'sbt'
            ]);
            $sbt = sk_hukuman_disiplin::findorFail($request['id_permohonan']);
            if($request['ttd']=='1'){
                $sbt->update([
                    'file_name'=>$request->id,
                    'status'=>5,
                ]);
            }else{
                $sbt->update([
                    'file_name'=>$request->id,
                    'status'=>4,
                    
                ]);
            }
            
            if($surat && $sbt){
            //redirect dengan pesan sukses
            return redirect()->back()->with('successs');
            }else{
                //redirect dengan pesan error
                return redirect()->back()->with('error');
            
        }
    }
    public function template_sbt($id)
    {
        $surat = Surat_bebas_temuan::where('id',$id)->get();
        $tipe = Surat_bebas_temuan::where('id',$id)->pluck('tipe')->first();
        $data = [
            'surat'=>$surat


        ];
        if($tipe == 'sbt'){
            return view('contentAdmin.template_sbt',$data);
        }
        else  
        {
            return view('contentAdmin.template_sktp',$data);
        }
           
    }   
    public function sktp()
    {
        $userID = Auth::user()->id;
        $sk = sk_hukuman_disiplin::paginate(5);
        $user = Auth::user()->name;
        $isAdmin = Auth::user()->is_admin;
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'sk'=>$sk
        ];
        return view('contentAdmin.surat_khd',$data);
    }
    public function addsktp($id)
    {

        $iduser = sk_hukuman_disiplin_detail::where('id_permohonan',$id)->pluck('id_pemohon')->first();
        $sktp = sk_hukuman_disiplin::where('id',$id)->pluck('status')->first();
        $iddetail = sk_hukuman_disiplin_detail::where('id_permohonan',$id)->pluck('id')->first();
        $surat = Surat_bebas_temuan::where('id_permohonan',$id)->where('id_permohonan_detail',$iddetail)->where('tipe','sktp')->get();   
        $suratid = Surat_bebas_temuan::where('id_permohonan',$id)->where('id_permohonan_detail',$iddetail)->where('tipe','sktp')->pluck('id')->first();         
        $userData = User::where('id',$iduser)->get();
        $dt = sk_hukuman_disiplin_detail::where('id_permohonan',$id)->get();
        $user = Auth::user()->name;
        $isAdmin = Auth::user()->is_admin;
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'userData' => $userData,
            'dt'=>$dt,
            'sktp'=>$sktp,
            'surat'=>$surat,
            'suratid'=>$suratid
        ];
        return view('contentAdmin.add_surat_khd',$data);
    }
    public function updateMessageSKTP(Request $request, $id)
    {

        // $msg = sk_bebas_temuan_detail::findOrFail($request->id);
        // $msg->update([
        //     'message' => $request->input('comment'),
        // ]);
        DB::transaction(function () use ($request,$id) {
            DB::table('sk_hukuman_disiplin_details')
            ->where('id', $id)
            ->update([
                'message' => $request->input('comment'),
            ]);
            DB::table('sk_hukuman_disiplins')
            ->where('id',$request->id_permohonan)
            ->update([
                'status' => $request->status
            ]);
        });
        return redirect()->back()->with('successs');
    }
    public function daftar_pengaduan()
    {
        $isAdmin = Auth::user()->is_admin;
        $userID = Auth::user()->id;
        $pengaduan = Pengaduan::orderBy('created_at','desc')->paginate(5);
        $user = Auth::user()->name;
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'aduan'=>$pengaduan
        ];
        return view('contentAdmin.pengaduan',$data);
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
        $idadmin = Pengaduan::where('roomID',$roomID)->pluck('id_admin')->first();
        $idpelapor= Pengaduan::where('roomID',$roomID)->pluck('id_user')->first();
        $UserRespon = User::where('id',$idadmin)->pluck('name')->first();
        $DataUser = User::where('id',$idpelapor)->get();
        $isAdmin = Auth::user()->is_admin;
        $room = Pengaduan::where('roomID',$roomID)->get();
        $user = Auth::user()->name;
        $IDuser = Auth::user()->id;
        $chat = Pengaduan_message::where('room_id',$roomID)->where('status',1)->orderBy('id','asc')->get(); 
        $firstID = Pengaduan_message::where('room_id',$roomID)->orderBy('id','asc')->pluck('UserID')->first();
        $data = [
            'isAdmin'=> $isAdmin,
            'user'=> $user,
            'IDuser'=>$IDuser,
            'chat'=> $chat,
            'room'=>$room,
            'roomID'=>$roomID,
            'firstID'=>$firstID,
            'UserRespon'=> $UserRespon,
            'DataUser'=>$DataUser
        ];
        return view('contentAdmin.pengaduan_detail',$data);     
    }

    public function addMessage_aduan(Request $request, $id)
    {
        $IDuser = Auth::user()->id;
        $now = Carbon::now();
        $timenow = now();
        $idroom = Pengaduan_message::where('id',$id)->pluck('room_id')->first();
        $request->validate(
            [
                'files' => 'mimes:jpeg,bmp,png,gif,svg,pdf,zip,rar',
    
            ]);
        if ( $request->hasFile('files')) {

            $file = $request->file('files');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('adminfrontend/aduanfile'), $filename);
            $msg = Pengaduan_message::findOrFail($id);
            $msg->update([
            'message'=>$request['comment'],
            'message_file'=>$filename,
            'status'=>1
            ]);
            $pengaduan = Pengaduan::where('roomID',$idroom);
            $pengaduan->update([
                    'id_admin'=> $IDuser,
                    'status'=>1,
                ]);
            }else{
                $msg = Pengaduan_message::findOrFail($id);
                $msg->update([
                'message'=>$request['comment'],
                'status'=>1
                ]);
                $pengaduan = Pengaduan::where('roomID',$idroom);
                $pengaduan->update([
                        'id_admin'=> $IDuser,
                        'status'=>1,
                    ]);
            }
            
            if($msg && $pengaduan){
            //redirect dengan pesan sukses
            return redirect()->back()->with('successs');
            }else{
                //redirect dengan pesan error
                return redirect()->back()->with('error');
            
        }
    }
}
