<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConferenceResource;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceApiController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 20;
        $conferences = Conference::when($request->search, function($query, $search) {
            $query->where('title', 'like', '%'. $search .'%');
        })->paginate($paginate);

        return $this->sendResponse(ConferenceResource::collection($conferences)->resource, 'Мероприятие получено успешно', 200);
    }
}
