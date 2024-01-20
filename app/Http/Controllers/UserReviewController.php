<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    public function index($user_id)
    {
        $reviews = Review::get()->where('user_id', $user_id);
        if (is_null($reviews)) {
            return response()->json('Data not found', 404);
        }
        return response()->json($reviews);
    }
}
