<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupApiController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 20;
        $groups = Group::when($request->search, function($query, $search) {
            $query->where('title', 'like', '%'. $search .'%');
        })->paginate($paginate);

        return $this->sendResponse(GroupResource::collection($groups)->resource, 'Год получен успешно', 200);
    }
}
