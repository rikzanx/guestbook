<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;

use App\Models\SuratJalan;
use App\Models\ImagesSuratJalan;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('suratjalan-register',[
            "today" => $today
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'bentuk' => 'required',
            'dari' => 'required',
            'tujuan' => 'required',
            'nomor_po' => 'required',
            'nama_penanggung_jawab' => 'required',
            'nomor' => 'required',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'required',
            'foto_suratjalans' => 'required'
        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->route("suratjalan.index")->with('danger', $validator->errors()->first());
        }
        // dd($request->all());
        DB::beginTransaction();
        try {
            $suratjalan = new SuratJalan();
            $suratjalan->nama_barang = $request->nama_barang;
            $suratjalan->jumlah = $request->jumlah;
            $suratjalan->bentuk = $request->bentuk;
            $suratjalan->dari = $request->dari;
            $suratjalan->tujuan = $request->tujuan;
            $suratjalan->nomor_po = $request->nomor_po;
            $suratjalan->nama_penanggung_jawab = $request->nama_penanggung_jawab;
            $suratjalan->nomor = $request->nomor;
            $suratjalan->waktu_masuk = $request->waktu_masuk;
            $suratjalan->waktu_keluar = $request->waktu_keluar;
            $suratjalan->save();
            if($request->hasfile('foto_suratjalans')){
                foreach($request->file('foto_suratjalans') as $file)
                {
                    $imagesuratjalan = new ImagesSuratJalan();
                    $uploadFolder = "img/foto_suratjalan/";
                    $image = $file;
                    $imageName = time().'-'.$image->getClientOriginalName();
                    $image->move(public_path($uploadFolder), $imageName);
                    $image_link = $uploadFolder.$imageName;
                    $imagesuratjalan->surat_jalan_id = $suratjalan->id;
                    $imagesuratjalan->image_surat_jalan = $image_link;
                    $imagesuratjalan->save();
                }
            }
            //commit
            DB::commit();
            return redirect()->route("suratjalan.index")->with('status', "Sukses menambahkan Surat Jalan");
        }catch(\Exception $e){
            DB::rollback();
            $ea = "Terjadi Kesalahan saat menambahkan Surat Jalan.".$e->message;
            return redirect()->route("suratjalan.index")->with('danger', "Terjadi Kesalahan saat menambahkan Surat Jalan.");

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
        //
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
