<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Enterprise\EnterpriseServiceRegistration;
use App\Service\V1\Enterprise\EnterpriseServiceShowAll;
use App\Service\V1\Enterprise\EnterpriseServiceShow;
use App\Service\V1\Enterprise\EnterpriseServiceUpdate;
use App\Http\Controllers\Controller;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $enterpriseServiceRegistration;
    protected $enterpriseServiceShowAll;
    protected $enterpriseServiceShow;
    protected $enterpriseServiceUpdate;

    public function __construct(
        EnterpriseServiceRegistration $enterpriseServiceRegistration,
        EnterpriseServiceShowAll $enterpriseServiceShowAll,
        EnterpriseServiceShow $enterpriseServiceShow,
        EnterpriseServiceUpdate $enterpriseServiceUpdate

    ) {
        $this->enterpriseServiceRegistration = $enterpriseServiceRegistration;
        $this->enterpriseServiceShowAll = $enterpriseServiceShowAll;
        $this->enterpriseServiceShow = $enterpriseServiceShow;
        $this->enterpriseServiceUpdate = $enterpriseServiceUpdate;
    }

    public function index()
    {
        //
        $enterprise = $this->enterpriseServiceShowAll->enterpriseShowAll();
        return response()->json(['data' => $enterprise]);
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
        $enterprise = $this->enterpriseServiceRegistration->store($request);
        return response()->json(['data' => $enterprise]);
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
        $enterprise = $this->enterpriseServiceShow->enterpriseShow($id);
        return response()->json(['data' => $enterprise]);
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
     public function update(int $id, Request $request)
    {
        $enterprise = $this->enterpriseServiceUpdate->enterpriseUpdate($id, $request);

        return response()->json(['data' => $enterprise]);

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
