<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchAppSetting(Request $request)
    {
        try {
            $query = AppSetting::select('*')
                    ->orderBy('id', 'desc')
                    ->get();
            

            return response(prepareResult(true, $query, trans('Record Fatched Successfully')), 200 , ['Result'=>'Your data has been saved successfully']);
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
            'site_name'     => 'nullable|max:250',
            'site_logo'     => 'nullable|image|mimes:png',
            'email'         => 'required|max:250',
            'facebook'      => 'nullable|url',
            'twitter'       => 'nullable|url',
            'linkedin'      => 'nullable|url',
            'youtube'       => 'nullable|url'
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {
            $info = new AppSetting;

            if(!empty($request->site_logo))
            {
              $file=$request->site_logo;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $info->site_logo=imageBaseURL().$request->site_logo->move('assets',$filename);
            }
            $info->site_name = $request->site_name;
            $info->email = $request->email;
            $info->phone = $request->phone;
            $info->facebook = $request->facebook;
            $info->twitter = $request->twitter;
            $info->linkedin = $request->linkedin;
            $info->youtube = $request->youtube;
            $info->about_us = $request->about_us;
            $info->address = $request->address;
            $info->save();
            DB::commit();
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
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            
            $info = AppSetting::select('*')
                  ->get();
            $data = $info[0];
                // return $data;
            return view('addappsetting')->with('data',$data);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('translate.something_went_wrong')), 500,  ['Result'=>'httpcodes.internal_server_error']);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AppSetting $appSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'site_name'     => 'nullable|max:250',
            'site_logo'     => 'nullable|image|mimes:png',
            'email'         => 'nullable|max:250',
            'facebook'      => 'nullable|url',
            'twitter'       => 'nullable|url',
            'linkedin'      => 'nullable|url',
            'youtube'       => 'nullable|url'
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {
            $info = AppSetting::find($id);

            if(!empty($request->site_logo))
            {
              $file=$request->site_logo;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $info->site_logo=imageBaseURL().$request->site_logo->move('assets',$filename);
            }
            $info->site_name = $request->site_name;
            $info->email = $request->email;
            $info->phone = $request->phone;
            $info->facebook = $request->facebook;
            $info->twitter = $request->twitter;
            $info->linkedin = $request->linkedin;
            $info->youtube = $request->youtube;
            $info->about_us = $request->about_us;
            $info->address = $request->address;
            $info->save();
            DB::commit();
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
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $info = AppSetting::find($id);
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
