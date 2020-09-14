<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ExpenseRepository;

class ExpenseController extends Controller
{
    protected $expenses;

    public function __construct(ExpenseRepository $expenses)
    {
        $this->expenses = $expenses;
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->expenses->index();
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
        return $this->expenses->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \int $expense_id
     * @return \Illuminate\Http\Response
     */
    public function show($expense_id)
    {
        return $this->expenses->show($expense_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \int $expense_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \int $expense_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $expense_id)
    {
        return $this->expenses->update($request, $expense_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \int  $expense_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($expense_id)
    {
        return $this->expenses->destroy($expense_id);
    }
}
