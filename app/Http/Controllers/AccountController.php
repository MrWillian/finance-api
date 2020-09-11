<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\AccountRepository;

class AccountController extends Controller
{
    protected $accounts;

    public function __construct(AccountRepository $accounts)
    {
        $this->accounts = $accounts;
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->accounts->index();
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
        return $this->accounts->createAccount($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \int $account_id
     * @return \Illuminate\Http\Response
     */
    public function show($account_id)
    {
        return $this->accounts->showAccount($account_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \int $account_id
     * @return \Illuminate\Http\Response
     */
    public function edit($account_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \int $account_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $account_id)
    {
        return $this->accounts->updateAccount($request, $account_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \int $account_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_id)
    {
        return $this->accounts->destroyAccount($account_id);
    }
}
