<?php

namespace App\Http\Controllers;

use App\Models\Newslatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NewslatterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchNewslatters()
    {
        try {
            $query = Newslatter::select('*')
                    ->orderBy('id', 'desc')
                    ->get();
           

            return $query;
        } 
        catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('Error while fatching Records')), 500,  ['Result'=>'Your data has not been saved']);
        }
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
       
        $validation = Validator::make($request->all(), [
            'email'                    => 'required',
             
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {
            $info = new Newslatter;
            $info->email = $request->email;
            $info->save();
            DB::commit();
            return $info;
            return response()->json(prepareResult(true, $info, trans('Your data has been saved successfully')), 200 , ['Result'=>'Your data has been saved successfully']);
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return response()->json(prepareResult(false, $e->getMessage(), trans('Your data has not been saved')), 500,  ['Result'=>'Your data has not been saved']);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newslatter  $newslatter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            
            $info = Newslatter::find($id);
            if($info)
            {
                return response(prepareResult(true, $info, trans('Record Featched Successfully')), 200 , ['Result'=>'httpcodes.found']);
            }
            return response(prepareResult(false, [], trans('Error while featching Records')),500,  ['Result'=>'httpcodes.not_found']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('translate.something_went_wrong')), 500,  ['Result'=>'httpcodes.internal_server_error']);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newslatter  $newslatter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newslatter $newslatter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newslatter  $newslatter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $validation = Validator::make($request->all(), [
            // 'email'                    => 'required',
             
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {
            $info = Newslatter::find($id);
            $info->email = $request->email;
            $info->save();
            DB::commit();
            return $info;
            return response()->json(prepareResult(true, $info, trans('Your data has been saved successfully')), 200 , ['Result'=>'Your data has been saved successfully']);
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return response()->json(prepareResult(false, $e->getMessage(), trans('Your data has not been saved')), 500,  ['Result'=>'Your data has not been saved']);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newslatter  $newslatter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $info = Newslatter::find($id);
            if($info)
            {
                $result=$info->delete();
                return response(prepareResult(true, $result, trans('Record Id Deleted Successfully')), 200 , ['Result'=>'httpcodes.found']);
            }
            return response(prepareResult(false, [], trans('Record Id Not Found')),500,  ['Result'=>'httpcodes.not_found']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('translate.something_went_wrong')), 500,  ['Result'=>'httpcodes.internal_server_error']);
        }
    }
}
