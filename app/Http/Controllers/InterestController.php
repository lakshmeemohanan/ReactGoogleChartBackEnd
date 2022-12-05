<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\InterestResource;
use App\Http\Resources\InterestCollection;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response\Json\AnnonymousResourceCollection
     */
    public function index(Request $request)
    {
        //return InterestResource::collection(Interest::all());
        //OR
       // return new InterestCollection(Interest::all());
       return response()->json(new InterestCollection(Interest::all()), Response::HTTP_OK);
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
     * @return InterestResource
     */
    public function store(Request $request)
    {
        $interest = Interest::create($request->only([
            'user_id','interests','created_at','updated_at'
        ]));
        return new InterestResource($interest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interest  $interest
     * @return InterestResource
     */
    public function show(Interest $interest)
    {
        return new InterestResource($interest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function edit(Interest $interest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interest $interest)
    {
        $interest->update($request->only([
            'user_id','interests','created_at','updated_at'
        ]));
        return new InterestResource($interest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interest $interest)
    {
        $interest->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
