<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = Group::when($request->search, function($query) use($request){
            $query->where('title', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('admin.groups.indexGroups', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Добавить год';

        return view('admin.groups.formGroups', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

        Group::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('groups.index')->with('success', 'Год добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $title = 'Редактировать год '.$group->title;

        return view('admin.groups.editGroups', compact('title', 'group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

            $group->title = $request->title;
            $group->slug = Str::slug($request->title);

            $group->update();

        return redirect()->route('groups.index')->with('success', 'Год изменен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        try {
            $group->deleteOrFail();

            return redirect()->route('groups.index')->with('danger', 'Год удален!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
