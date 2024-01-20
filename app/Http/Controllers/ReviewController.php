<?php

namespace App\Http\Controllers;


use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return new ReviewCollection($reviews);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //cuvamo objekat u bazi
        //da bismo proverili da li je objekat u bazi u skladu sa zahtevima
        $validator = FacadesValidator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
            'rating' => 'required',
            'category_id' => 'required',
            'city' => 'required'
        ]);

        $review = Review::create([
            'title' => $request->title,
            'body' => $request->body,
            'rating' => $request->rating,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'city' => $request->city
        ]);
    
        return response()->json(['Review created successfully.', new ReviewResource($review)]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(review $review)
    {
        return new ReviewResource($review);

    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, review $review)
    {
        $validator = FacadesValidator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
            'rating' => 'required',
            'category_id' => 'required',
            'city' => 'required'

        ]);


        $review->title = $request->title;
        $review->body = $request->body;
        $review->rating = $request->rating;
        $review->category_id = $request->category_id;
        $review->city = $request->city;

        $review->save();

        
        return response()->json(['Review updated successfully.', new ReviewResource($review)]);
    }

    /**
     * Remove the specified resource from storage.
     *@param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     
     */
    public function destroy(review $review)
    {
        $review->delete();
        return response()->json('Review deleted successfully.');
    }
}
