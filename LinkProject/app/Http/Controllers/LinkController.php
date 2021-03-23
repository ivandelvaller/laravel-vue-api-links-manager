<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::orderBy('created_at', 'ASC');

        return response()->json([
            "count" => $links->count(),
            "links" => $links->get(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newLink = new Link();

        $newLink->title = $request['title'];
        $newLink->thumbnail = $request['thumbnail'];
        $newLink->description = $request['description'];
        $newLink->link = $request['link'];

        try {
            $newLink->save();

            return response()->json([
                "success" => true,
                "link" => $newLink
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "error" => $th
            ], 400);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $keys = $request->keys();
        $allowedUpdates = ["title", "thumbnail", "description", "link"];
        $isValidOperation = true;

        $linkToUpdate = Link::find($id);

        if ($linkToUpdate) {
            foreach ($keys as $key) {
                if (!in_array($key, $allowedUpdates)) {
                    $isValidOperation = false;
                    break;
                }
            }
        } else {
            return response()->json([
                "success" => false,
                "error" => 'Resource was not found.'
            ], 404);
        }

        if ($isValidOperation) {
            foreach ($keys as $key) {
                $linkToUpdate[$key] = $request[$key];
            }

            $linkToUpdate->save();

            return response()->json([
                "success" => true,
                "link" => $linkToUpdate
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "error" => "Invalid operation."
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $linkToDelete = Link::find($id);

        if ($linkToDelete) {
            $linkToDelete->delete();

            return response()->json([
                "success" => true
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "error" => 'Resource was not found.'
            ], 404);
        }
    }
}
