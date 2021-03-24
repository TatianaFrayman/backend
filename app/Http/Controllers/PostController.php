<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Post index
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        if ($request->error){
            abort(400, "error in request");
        }

        return response()->json([
            "request" => $request->all()
        ]);
    }

    /**
     * Show single post
     *
     * @param Request $request
     * @param int $post
     */
    public function show(Request $request, int $post): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "there'll be post with id $post"
        ]);
    }

    /**
     * Create new post
     *
     * @param Request $request
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        if (
            !$request-> title
        ||!$request -> text
        ){
            abort(400,  "required data missing");
        }
        return response()->json([
            "message" => "post will be created",
            "request" => $request->all()
        ], 201);
    }

    /**
     * Update post
     *
     * @param Request $request
     */

    public function update(Request $request, int $post): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message"=>"post $post will be updated"
        ]);
    }

    /**
     * Delete post
     *
     * @param Request $request
     */
    public function destroy(Request $request, int $post): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message"=>"post $post will be deleted"
        ]);
    }
}

