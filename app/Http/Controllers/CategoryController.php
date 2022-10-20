<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCategory(Request $request)
    {
        try {
            $query = Category::select('*')
                ->with('subcategory:id,parent_id,name as sname,description')
                ->whereNull('parent_id')
                ->orderBy('id', 'desc')
                ->get();
            $info = AppSetting::select('*')
                ->get();
            $data = $info[0];
            return view('category')->with('query', $query)->with('data', $data);
            // return response(prepareResult(true, $query, trans('Record Fatched Successfully')), 200 , ['Result'=>'Your data has been saved successfully']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('Error while fatching Records')), 500,  ['Result' => 'Your data has not been saved']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSubCategory()
    {
        $query = Category::select('*')
            ->with('subcategory:id,parent_id,name as sname,description')
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->get();
            $info = AppSetting::select('*')
                ->get();
            $data = $info[0];
        return view('subcategory')->with('query', $query)->with('data', $data);
    }


    public function viewAddCategory()
    {
      
    

            $info = AppSetting::select('*')
                ->get();
            $data = $info[0];
        return view('addcategory')->with('data', $data);
    }
    public function viewAddSubCategory()
    {
        $query = Category::select('*')
            ->with('subcategory:id,parent_id,name as sname,description')
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->get();

            $info = AppSetting::select('*')
                ->get();
            $data = $info[0];
        return view('addsubcategory')->with('query', $query)->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name'                    => 'required|unique:categories,name',

        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result' => 'Your data has not been saved']);
        }

        DB::beginTransaction();
        try {
            $info = new Category;
            $info->name = $request->name;
            $info->parent_id = $request->parent_id;
            $info->description = $request->description;
            $info->save();
            DB::commit();
            return redirect('categorys');
            // return response()->json(prepareResult(true, $info, trans('Your data has been saved successfully')), 200 , ['Result'=>'Your data has been saved successfully']);
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return response()->json(prepareResult(false, $e->getMessage(), trans('Your data has not been saved')), 500,  ['Result' => 'Your data has not been saved']);
        }
    }


    public function storeSubCategory(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name'                    => 'required|unique:categories,name',

        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result' => 'Your data has not been saved']);
        }

        DB::beginTransaction();
        try {
            $info = new Category;
            $info->name = $request->name;
            $info->parent_id = $request->parent_id;
            $info->description = $request->description;
            $info->save();
            DB::commit();
            return redirect('subcategories')->with('status', 'subcategory created!');
            // return response()->json(prepareResult(true, $info, trans('Your data has been saved successfully')), 200 , ['Result'=>'Your data has been saved successfully']);
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return response()->json(prepareResult(false, $e->getMessage(), trans('Your data has not been saved')), 500,  ['Result' => 'Your data has not been saved']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $info = Category::find($id);
            if ($info) {
                return response(prepareResult(true, $info, trans('Record Featched Successfully')), 200, ['Result' => 'httpcodes.found']);
            }
            return response(prepareResult(false, [], trans('Error while featching Records')), 500,  ['Result' => 'httpcodes.not_found']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('translate.something_went_wrong')), 500,  ['Result' => 'httpcodes.internal_server_error']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function editCategory($id)
    {
        $info = DB::table('categories')->find($id);
        $q = AppSetting::select('*')
                ->get();
            $data = $q[0];
        return view('editcategory')->with('info', $info)->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            // 'name'                    => 'required|unique:categories,name',

        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), trans('validation_failed')), 500,  ['Result' => 'Your data has not been saved']);
        }

        DB::beginTransaction();
        try {
            $info = Category::find($id);
            $info->name = $request->name;
            $info->parent_id = $request->parent_id;
            $info->description = $request->description;
            $info->save();
            DB::commit();
            return redirect('categorys')->with('status', 'category updated!');
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return response()->json(prepareResult(false, $e->getMessage(), trans('Your data has not been Updated')), 500,  ['Result' => 'Your data has not been saved']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory($id)
    {
        try {

            $info = Category::find($id);
            if ($info) {
                $result = $info->delete();
                return redirect('categorys')->with('status', 'category deleted!');
            }
            return response(prepareResult(false, [], trans('Record Id Not Found')), 500,  ['Result' => 'httpcodes.not_found']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('translate.something_went_wrong')), 500,  ['Result' => 'httpcodes.internal_server_error']);
        }
    }

    public function destroySubCategory($id)
    {
        try {

            $info = Category::find($id);
            if ($info) {
                $result = $info->delete();
                return redirect('subcategories')->with('status', 'subcategory deleted!');
            }
            return response(prepareResult(false, [], trans('Record Id Not Found')), 500,  ['Result' => 'httpcodes.not_found']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('translate.something_went_wrong')), 500,  ['Result' => 'httpcodes.internal_server_error']);
        }
    }
}
