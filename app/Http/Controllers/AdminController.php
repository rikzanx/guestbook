<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;
use Auth;
use App\Models\Guest;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
            $this->middleware('auth',['tes' => 'egg']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bulan = 0;
        $months = array(
            0 => "Pilih Bulan"
        );
        for ($i = 1; $i <= 12; $i++) {
            $timestamp = mktime(0, 0, 0, $i, 1);
            array_push($months,date('F', $timestamp));
        }
        $date = Carbon::today();
        $date_to = Carbon::today();
        $guests = Guest::whereDate('created_at', '=', Carbon::today())->orderBy('id','DESC')->get();
        if($request->has("date")){
            $date = Carbon::createFromFormat('Y-m-d',  $request->date); 
            $guests = Guest::WhereDate('created_at','=',$date)->orderBy('id','DESC')->get();
            if($request->has("date_to")){
                $date_to = Carbon::createFromFormat('Y-m-d',  $request->date_to); 
                $guests = Guest::whereDate('created_at', '>=' ,$request->date)->whereDate('created_at','<=',$request->date_to)->orderBy('id','DESC')->get();
            }
        }

        if($request->has("bulan")){
            try{
                if($request->bulan >= 1 && $request->bulan <= 12){
                    $bulan = $request->bulan;
                    $date = Carbon::createFromFormat('Y-m',  '2023-'.$request->bulan)->startOfMonth(); 
                    $date_to = Carbon::createFromFormat('Y-m',  '2023-'.$request->bulan)->endOfMonth(); 
                    $guests = Guest::whereDate('created_at', '>=' ,$date)->whereDate('created_at','<=',$date_to)->orderBy('id','DESC')->get();
                }

            }catch(\Exception $e){

            }
        }
        
        return view('admin.listguest',[
            'guests' => $guests,
            'date' => $date->format('Y-m-d'),
            'date_to' => $date_to->format('Y-m-d'),
            'months' => $months,
            'bulan' => $bulan

        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        // dd("aaa");
        $date = Carbon::today();
        $guests = Guest::orderBy('id','DESC')->get();
        if($request->has("date")){
            $date = Carbon::createFromFormat('Y-m-d',  $request->date); 
            $guests = Guest::orderBy('id','DESC')->get();
        }
        
        return view('admin.all-listguest',[
            'guests' => $guests,
            'date' => $date->format('Y-m-d')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        // dd($category);
        return view('admin.guest-edit',[
            'guest' => $guest
        ]);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_badan_usaha' => 'required',
            'lokasi_pekerjaan'=> 'required',
            'departemen'=> 'required',
            'jenis_pekerjaan'=> 'required',
            'jumlah_personil'=> 'required',
            'nama_safety_upload'=> 'required',
            'no_hp'=> 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route("guest.index")->with('danger', $validator->errors()->first());
        }

        $guest = Guest::findOrFail($id);
        $guest->nama_badan_usaha = $request->nama_badan_usaha;
        $guest->lokasi_pekerjaan = $request->lokasi_pekerjaan;
        $guest->departemen = $request->departemen;
        $guest->jenis_pekerjaan = $request->jenis_pekerjaan;
        $guest->jumlah_personil = $request->jumlah_personil;
        $guest->nama_safety_upload = $request->nama_safety_upload;
        $guest->no_hp = $request->no_hp;
        if($request->has('foto_lembar_depan')){
            $uploadFolder = "img/foto_lembar_depan/";
            $image = $request->file('foto_lembar_depan');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $guest->foto_lembar_depan = $uploadFolder.$imageName;
        }

        if($guest->save()){
            return redirect()->route("guest.index")->with('status', "Sukses mengedit KIB");
        }else{
            return redirect()->route("guest.index")->with('danger', "Terjadi Kesalahan saat mengedit KIB.");
        }
    }

    public function verifikasi(Request $request, $id)
    {
        // dd('ok');
        $guest = Guest::findOrFail($id);
        $guest->verifikasi = "Terverifikasi";

        if($guest->save()){
            return redirect()->route("guest.index")->with('status', "Sukses memverfikasi KIB");
        }else{
            return redirect()->route("guest.index")->with('danger', "Terjadi Kesalahan saat memverfikasi KIB.");
        }
    }

    public function verifikasiall()
    {
        
        DB::beginTransaction();
        try{
            $update = Guest::where('verifikasi','!=','Terverifikasi')->update(["verifikasi"=>"Terverifikasi"]);
            
            DB::commit();
            return redirect()->route("guest.index")->with('status', "Sukses memverfikasi KIB");
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route("guest.index")->with('danger', "Terjadi Kesalahan saat memverfikasi KIB.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Guest::destroy($id)){
            return redirect()->route("guest.index")->with('status', "Sukses menghapus guest");
        }else {
            return redirect()->route("guest.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
