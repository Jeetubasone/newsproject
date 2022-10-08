<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchNews(Request $request)
    {
        try {
            $query = 	DB::table('news')
				->join("categories", "news.category_id", "=", "categories.id")
                // ->join("categories", "news.subcategory_id", "=", "categories.id")
                ->whereNull('categories.parent_id')
                // ->join("categories", "news.subcategory_id", "=", "categories.id")
                // ->where('categories.parent_id')
				->select(array('categories.id', 'categories.name as category_name', 'news.*' ))
                // ->select( 'news.*' ,)
				->orderBy('news.created_at', 'desc')
                ->get();
				
                // $re[] = $data;
           

            return view('news')->with('query', $query);
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
        return view('addnews')->with('query', $query)->with('query1', $query1);
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
            // 'title'                    => 'required',
            // 'content'                    => 'required',
             
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {

            $infoCategory = Category::find($request->subcategory_id);

            $info = new News;

            if(!empty($request->image))
            {
              $file=$request->image;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $info->image=imageBaseURL().$request->image->move('assets',$filename);
            }
            $info->title = $request->title;
            $info->content = $request->content;
            $info->date = $request->date;
            $info->category_id = $request->category_id;
            $info->subcategory_id = $request->subcategory_id;
            $info->subcategory_name = $infoCategory->name;
            $info->location = $request->location;
            $info->total_view = $request->total_view;
            $info->save();
            DB::commit();
            return $info;
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return response()->json(prepareResult(false, $e->getMessage(), trans('Your data has not been saved')), 500,  ['Result'=>'Your data has not been saved']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            
            $info = News::find($id);
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
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = News::find($id);
        $query = Category::select('*')
        ->whereNull('parent_id')
        ->orderBy('id', 'desc')
        ->get();
        $query1 = Category::select('*')
        ->whereNotNull('parent_id')
        ->orderBy('id', 'desc')
        ->get();
        return view('editnews')->with('info', $info)->with('query', $query)->with('query1', $query1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            // 'title'                    => 'required',
            // 'content'                    => 'required',
             
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), $validation->errors()), 500,  ['Result'=>'Your data has not been saved']);
        }
        
        DB::beginTransaction();
        try {
            $info = News::find($id);

            if(!empty($request->image))
            {
              $file=$request->image;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $info->image=imageBaseURL().$request->image->move('assets',$filename);
            }
            $info->title = $request->title;
            $info->content = $request->content;
            $info->date = $request->date;
            $info->category_id = $request->category_id;
            $info->subcategory_id = $request->subcategory_id;
            $info->location = $request->location;
            $info->total_view = $request->total_view;
            $info->save();
            DB::commit();
            return redirect('/all-news')->with('status', 'news updated!');
        } catch (\Throwable $e) {
            Log::error($e);
            DB::rollback();
            return response()->json(prepareResult(false, $e->getMessage(), trans('Your data has not been saved')), 500,  ['Result'=>'Your data has not been saved']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $info = News::find($id);
            if($info)
            {
                $result=$info->delete();
                return redirect('/all-news')->with('status', 'news deleted!');
            }
            return response(prepareResult(false, [], trans('Record Id Not Found')),500,  ['Result'=>'httpcodes.not_found']);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('translate.something_went_wrong')), 500,  ['Result'=>'httpcodes.internal_server_error']);
        }
    }
}
