<?php

namespace App\Http\Controllers;

use App\Models\YTComment;
use App\Http\Requests\StoreYTCommentRequest;
use App\Http\Requests\UpdateYTCommentRequest;

class YTCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreYTCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(YTComment $yTComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateYTCommentRequest $request, YTComment $yTComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YTComment $yTComment)
    {
        //
    }
}
