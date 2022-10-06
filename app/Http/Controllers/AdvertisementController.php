<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchAdvertisement(Request $request)
    {
        try {
            $query = Advertisement::select('*')
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
        $query = Category::select('*')
        ->with('subcategory:id,parent_id,name as sname,description')
        ->whereNull('parent_id')
        ->orderBy('id', 'desc')
        ->get();
        $query1 = Category::select('*')
        ->whereNotNull('parent_id')
        // ->where('parent_id', $query->id)
        ->orderBy('id', 'desc')
        ->get();
        return view('ads')->with('query', $query)->with('query1', $query1);
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
            'add_rate' => 'required|numeric',
            'add_position' => 'required',
            'add_image' => 'nullable|image',
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {
            $info = new Advertisement;

            if(!empty($request->add_image))
            {
              $file=$request->add_image;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $info->add_image=imageBaseURL().$request->add_image->move('assets',$filename);
            }
            $info->category_id = $request->category_id;
            $info->subcategory_id = $request->subcategory_id;
            $info->add_rate = $request->add_rate;
            $info->add_position = $request->add_position;
            $info->add_date = $request->add_date;
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
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            
            $info = Advertisement::find($id);
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
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            // 'add_rate' => 'required|numeric',
            // 'add_position' => 'required|integer',
            // 'add_image' => 'nullable|image',
            // 'date' => 'required',
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {
            $info = Advertisement::find($id);

            if(!empty($request->add_image))
            {
              $file=$request->add_image;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $info->add_image=imageBaseURL().$request->add_image->move('assets',$filename);
            }
            $info->category_id = $request->category_id;
            $info->subcategory_id = $request->subcategory_id;
            $info->add_rate = $request->add_rate;
            $info->add_position = $request->add_position;
            $info->add_date = $request->add_date;
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
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $info = Advertisement::find($id);
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
