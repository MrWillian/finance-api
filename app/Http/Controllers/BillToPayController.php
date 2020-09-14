<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\BillToPayRepository;

class BillToPayController extends Controller
{
    protected $billsToPay;

    public function __construct(BillToPayRepository $billsToPay) 
    {
        $this->billsToPay = $billsToPay;
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->billsToPay->index();
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
        return $this->billsToPay->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $billToPayID
     * @return \Illuminate\Http\Response
     */
    public function show($billToPayID)
    {
        return $this->billsToPay->show($billToPayID);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BillToPay  $billToPay
     * @return \Illuminate\Http\Response
     */
    public function edit(BillToPay $billToPay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $billToPayID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $billToPayID)
    {
        return $this->billsToPay->update($request, $billToPayID);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $billToPayID
     * @return \Illuminate\Http\Response
     */
    public function destroy($billToPayID)
    {
        return $this->billsToPay->destroy($billToPayID);
    }
}
