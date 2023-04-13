<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;

use App\Models\Guest;
use App\Models\Blokir;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('authpos',['ddd'=>'dddj']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = Carbon::today();
        $date_to = Carbon::today();
        $guests = Guest::whereDate('created_at', '=', Carbon::today())->where('verifikasi','Terverifikasi')->orderBy('id','DESC')->get();
        if($request->has("date")){
            $date = Carbon::createFromFormat('Y-m-d',  $request->date); 
            $guests = Guest::whereDate('created_at', '=', $request->date)->where('verifikasi','Terverifikasi')->orderBy('id','DESC')->get();
            if($request->has('date_to')){
                $date_to = Carbon::createFromFormat('Y-m-d',  $request->date_to); 
                $guests = Guest::whereDate('created_at', '>=', $request->date)->whereDate('created_at','<=',$request->date_to)->where('verifikasi','Terverifikasi')->orderBy('id','DESC')->get();
            }
        }
        
        return view('pos.guest.listguest',[
            'guests' => $guests,
            'date' => $date->format('Y-m-d'),
            'date_to' => $date_to->format('Y-m-d'),
        ]);
    }

    public function indexblokir()
    {
        $blokirs = Blokir::get();
        return view('pos.blokir.listblokir',[
            'blokirs' => $blokirs
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
