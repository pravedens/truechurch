<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $posts = Post::when($request, function ($query) use ($request) {
            if ($request->search) {
                $query->where('title', 'like', '%'.$request->search.'%');
            }
            if ($request->category) {
                $query->where('category_id', $request->category);
            }
            if ($request->groups) {
                $query->where('group_id', $request->group);
            }
            if ($request->conferences) {
                $query->where('conference_id', $request->conference);
            }
        })->paginate($paginate);

        return $this->sendResponse(PostResource::collection($posts)->resource, 'Публикация получена успешно', 200);
    }
}
