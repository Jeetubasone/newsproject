<?php
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


function prepareResult($error, $data, $msg)
	{
		return ['success' => $error, 'data' => $data, 'message' => $msg];
	}



function imageBaseURL() {

return "http://192.168.1.38:8000/";
// return "https://backend.gofactz.com/public/";

}

function getUser() {
	return auth('api')->user();
}

function fourNews(){
	$query = 	DB::table('news')
				->join("categories", "news.category_id", "=", "categories.id")
                // ->join("categories", "news.subcategory_id", "=", "categories.id")
                ->whereNull('categories.parent_id')
                // ->join("categories", "news.subcategory_id", "=", "categories.id")
                // ->where('categories.parent_id')
				->select(array('categories.id', 'categories.name as category_name', 'news.*' ))
                // ->select( 'news.*' ,)
				->orderBy('news.created_at', 'desc')
                ->limit(4)
                ->get();

				return  $query;

}

function allNews(){
	$query1 = 	DB::table('news')
				->join("categories", "news.category_id", "=", "categories.id")
                // ->join("categories", "news.subcategory_id", "=", "categories.id")
                ->whereNull('categories.parent_id')
                // ->join("categories", "news.subcategory_id", "=", "categories.id")
                // ->where('categories.parent_id')
				->select(array('categories.id', 'categories.name as category_name', 'news.*' ))
                // ->select( 'news.*' ,)
                ->get();
                // $re[] = $data;

				return  $query1;

}
