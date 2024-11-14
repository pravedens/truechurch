<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $categories = Category::when($request->search, function($query, $search) {
            $query->where('title', 'like', '%'. $search .'%');
        })->paginate($paginate);

        return $this->sendResponse(CategoryResource::collection($categories)->resource, 'Спикер получен успешно', 200);
    }
}
