<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function list(Request $request) {
        return new PostCollection(Post::all());
    }

    public function get(Request $request, $id) {
        return new PostResource(Post::findOrFail($id));
    }

    public function delete(Request $request, $id) {
        Post::where('id', '=', $id)->delete();
        return response()->noContent();
    }
}
