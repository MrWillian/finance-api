<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    protected $transactions;

    public function __construct(TransactionRepository $transactions)
    {
        $this->transactions = $transactions;
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->transactions->index();
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
        return $this->transactions->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \int $transaction_id
     * @return \Illuminate\Http\Response
     */
    public function show($transaction_id)
    {
        return $this->transactions->show($transaction_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transaction_id)
    {
        return $this->transactions->update($request, $transaction_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \int $transaction_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($transaction_id)
    {
        return $this->transactions->destroy($transaction_id);
    }
}
