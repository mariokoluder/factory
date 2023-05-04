<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MealCollection;
use App\Models\Meal;
use App\Models\Tag;
use Carbon\Carbon;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $meals = Meal::paginate($request->per_page ? $request->per_page : null);
        if($request->diff_time) {
            $meals = Meal::whereDate('created_at', '<=', Carbon::createFromTimestamp($request->diff_time)->format('Y-m-d H:i:s'))
                           ->orWhereDate('updated_at', '<=', Carbon::createFromTimestamp($request->diff_time)->format('Y-m-d H:i:s'))
                           ->orWhereDate('deleted_at', '<=', Carbon::createFromTimestamp($request->diff_time)->format('Y-m-d H:i:s'))
                           ->withTrashed()
                           ->paginate($request->per_page ? $request->per_page : null);
        } else {
            $meals = Meal::paginate($request->per_page ? $request->per_page : null);
        }
        
        if($request->tags) {
            $tags = explode(',', $request->tags);
            $meals = Meal::whereHas('tags', function($q) use($tags) {
                $q->whereIn('tag_id', $tags);
            })->paginate();
        }

        return new MealCollection($meals);
    }
}
