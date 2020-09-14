<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\BillToReceiveRepository;

class BillToReceiveController extends Controller
{
    protected $billsToReceive;

    public function __construct(BillToReceiveRepository $billsToReceive) 
    {
        $this->billsToReceive = $billsToReceive;
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->billsToReceive->index();
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
        return $this->billsToReceive->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $billToReceiveID
     * @return \Illuminate\Http\Response
     */
    public function show($billToReceiveID)
    {
        return $this->billsToReceive->show($billToReceiveID);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BillToReceive  $billToReceive
     * @return \Illuminate\Http\Response
     */
    public function edit(BillToReceive $billToReceive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $$billToReceiveID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $billToReceiveID)
    {
        return $this->billsToReceive->update($request, $billToReceiveID);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $billToReceiveID
     * @return \Illuminate\Http\Response
     */
    public function destroy($billToReceiveID)
    {
        return $this->billsToReceive->destroy($billToReceiveID);
    }
}
