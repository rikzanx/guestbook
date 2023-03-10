<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;

use App\Models\Simb;

class SimbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('simb-register',[
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
            'nama' => 'required',
            'nik' => 'required',
            'nomor_surat' => 'required',
            'departemen' => 'required',
            'dari' => 'required',
            'tujuan' => 'required',
            'no_mb' => 'required',
            'barang' => 'required',
            'foto_simb' => 'required',
            'pos_izin' => 'required',
        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->route("simb.index")->with('danger', $validator->errors()->first());
        }
        // dd($request->all());
        $uploadFolder = "img/foto_simb/";
        $image = $request->file('foto_simb');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;

        $simb = Simb::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nomor_surat' => $request->nomor_surat,
            'departemen' => $request->departemen,
            'dari' => $request->dari,
            'tujuan' => $request->tujuan,
            'no_mb' => $request->no_mb,
            'barang' => $request->barang,
            'foto_simb' => $image_link,
            'pos_izin' => $request->pos_izin,
            'lainnya' => ($request->has('lainnya')) ? $request->lainnya : null,
        ]);

        if($simb){
            return redirect()->route("simb.index")->with('status', "Sukses menambahkan SIM B");
        }else{
            return redirect()->route("simb.index")->with('danger', "Terjadi Kesalahan saat menambahkan SIM B.");
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
