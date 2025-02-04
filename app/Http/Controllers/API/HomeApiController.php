<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;

class HomeApiController extends Controller
{
    public function index()
    {
        $paginate = 4;
        $posts = Post::with('category', 'group', 'conference')->orderBy('created_at', 'desc')->paginate($paginate);

        return $this->sendResponse(PostResource::collection($posts)->resource, 'Публикация получена успешно', 200);
    }
}
