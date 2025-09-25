<?php

namespace App\Http\Controllers\Webpanel;

use Illuminate\Http\Request;

class JobProgressCtrl extends Controller
{
    public function __construct(){
        $this->prefix = 'back-end';
        $this->module = request()->segment(2);
    }
    public function index()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id','job_progress.step1','job_progress.step2','job_progress.step3','cp.id as companyId','cp.name_th','cp.name_jp','cp.public','cp.public_by'
        ])
        ->leftJoin('company as cp','job_progress.company','=','cp.id')
        ->where(['step1'=>1,'step2'=>1])
        ->get();

        return view("$this->prefix.moules.job-progress.index",[
            'prefix' => $this->prefix,
            'module'=> $this->module,
            'rows' => $data
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
