<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;

use App\Models\Guest;
use App\Mail\GuestMail;
use Mail;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('guest-register',[
            "today" => $today
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_badan_usaha' => 'required',
            'lokasi_pekerjaan'=> 'required',
            'departemen'=> 'required',
            'jenis_pekerjaan'=> 'required',
            'jumlah_personil'=> 'required',
            'foto_lembar_depan'=> 'required',
            'nama_safety_upload'=> 'required',
            'no_hp'=> 'required',
        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->route("index")->with('danger', $validator->errors()->first());
        }
        // dd($request->all());
        $uploadFolder = "img/foto_lembar_depan/";
        $image = $request->file('foto_lembar_depan');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;

        $guest = Guest::create([
            'nama_badan_usaha' => $request->nama_badan_usaha,
            'lokasi_pekerjaan'=> $request->lokasi_pekerjaan,
            'departemen'=> $request->departemen,
            'jenis_pekerjaan'=> $request->jenis_pekerjaan,
            'jumlah_personil'=> $request->jumlah_personil,
            'ktp'=> ($request->has('ktp')) ? $request->ktp : null,
            'kib' => ($request->has('kib')) ? $request->kib : null,
            'surat_kesehatan'=> ($request->has('surat_kesehatan')) ? $request->surat_kesehatan : null,
            'lainnya'=> ($request->has('lainnya')) ? $request->lainnya_isi : null,
            'foto_lembar_depan'=> $image_link,
            'nama_safety_upload'=> $request->nama_safety_upload,
            'no_hp'=> $request->no_hp,
        ]);

        if($guest){
            return redirect()->route("index")->with('status', "Sukses menambahkan kategori");
        }else{
            return redirect()->route("index")->with('danger', "Terjadi Kesalahan saat menambahkan kategori.");
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
