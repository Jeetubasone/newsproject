<?php

namespace App\Http\Controllers;

use App\Models\PublicView;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PublicViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = fourNews();
            $query1 = allNews();
            $ads = Advertisement::select('*')
                    ->orderBy('id', 'desc')
                    ->get();
            return view('index')->with('query', $query)->with('query1', $query1)->with('ads', $ads);
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
    public function categoryNews(Request $request)
    {
        try {
            $query = allNews();
            return view('category1')->with('query', $query);
           
        } 
        catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('Error while fatching Records')), 500,  ['Result'=>'Your data has not been saved']);
        }
    }
    public function categoryWiseNewsDetail(Request $request)
    {
        try {

            $query = allNews();

                $query2 = DB::table('news')
                    ->join("categories", "news.category_id", "=", "categories.id")
                    // ->join("categories", "news.subcategory_id", "=", "categories.id")
                    ->whereNull('categories.parent_id')
                    ->where('news.category_id', $request->id)
                    // ->join("categories", "news.subcategory_id", "=", "categories.id")
                    // ->where('categories.parent_id')
                    ->select(array('categories.id', 'categories.name as category_name', 'news.*' ))
                    // ->select( 'news.*' ,)
				    ->orderBy('news.created_at', 'desc')
                    
                    ->get();

				
                // $re[] = $data;
           

            return view('categorywise')->with('query', $query)->with('query2', $query2);
            // return $query2;
        } 
        catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('Error while fatching Records')), 500,  ['Result'=>'Your data has not been saved']);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function singleNews()
    {
        try {
            $query = allNews();
           

            return view('single')->with('query', $query);
        } 
        catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('Error while fatching Records')), 500,  ['Result'=>'Your data has not been saved']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicView  $publicView
     * @return \Illuminate\Http\Response
     */
    public function showNewsContent(Request  $request)

    {

        $query = 	allNews();
				 
        $query2 = DB::table('news')
        ->join("categories", "news.category_id", "=", "categories.id")
        // ->join("categories", "news.subcategory_id", "=", "categories.id")
        ->whereNull('categories.parent_id')
        ->where('news.id', $request->id)
        // ->join("categories", "news.subcategory_id", "=", "categories.id")
        // ->where('categories.parent_id')
        ->select(array('categories.id', 'categories.name as category_name', 'news.*' ))
        // ->select( 'news.*' ,)
        ->orderBy('news.created_at', 'desc')
        ->get();

        return view('singlenewsdetails')->with('query', $query)->with('query2', $query2);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicView  $publicView
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicView $publicView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PublicView  $publicView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicView $publicView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicView  $publicView
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicView $publicView)
    {
        //
    }
}
