<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\News;
use App\Models\Category;
use App\Models\Advertisement;
use App\Models\Newslatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalDetails()
    {
        try {
            // $data = [];
            $totalads = Advertisement::count();
            $totalnews = News::count();
            $newslatters = Newslatter::all();
            $category = Category::whereNull('parent_id')->get('id');
            $i = 0;
            foreach ($category as  $c) {
                $data1 = Category::find($c->id);
                $i = $i + 1;
                $data['id'] = $i;
                $data['name'] = $data1->name;
                $data['total'] = News::select('id')->where('category_id', $c->id)->count();
                $details[] = $data;
            }
            return view('dashboard', compact('totalnews', 'totalads','details','newslatters'));
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('Error while fatching Records')), 500,  ['Result' => 'Your data has not been saved']);
        }
    }

    /**67
     * 13 `+
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryWiseNews()
    {

        try {
            $category = Category::whereNull('parent_id')->get('id');
            $i = 0;
            foreach ($category as  $c) {
                $data1 = Category::find($c->id);
                $i = $i + 1;
                $data['id'] = $i;
                $data['name'] = $data1->name;
                $data['total'] = News::select('id')->where('category_id', $c->id)->count();
                $details[] = $data;
            }
            return $details;
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(prepareResult(false, $e->getMessage(), trans('Error while fatching Records')), 500,  ['Result' => 'Your data has not been saved']);
        }
        // $data = 	DB::table('news')
        // 		->join("categories", "news.category_id", "=", "categories.id")
        //         // ->where('categories.id', $c)
        // 		->select(array('categories.id', 'categories.name', DB::Raw('count(news.id) as total_news ') ))
        // 		->groupBy(['categories.id', 'categories.name'])
        // 		->orderBy('news.created_at', 'desc')
        // 		->get();
        //         $re[] = $data;

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
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
