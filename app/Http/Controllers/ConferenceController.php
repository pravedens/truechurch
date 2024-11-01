<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $conferences = Conference::when($request->search, function($query) use($request){
            $query->where('title', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('admin.conferences.indexConferences', compact('conferences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Добавить мероприятие';

        return view('admin.conferences.formConferences', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

        Conference::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('conferences.index')->with('success', 'Мероприятие добавлено!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conference $conference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conference $conference)
    {
        $title = 'Редактировать мероприятие '.$conference->title;

        return view('admin.conferences.editConferences', compact('title', 'conference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conference $conference)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

            $conference->title = $request->title;
            $conference->slug = Str::slug($request->title);

            $conference->update();

        return redirect()->route('conferences.index')->with('success', 'Мероприятие изменено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conference $conference)
    {
        try {
            $conference->deleteOrFail();

            return redirect()->route('conferences.index')->with('danger', 'Мероприятие удалено!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
