<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Conference;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::when($request->search, function($query) use($request){
            $query->where('title', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('admin.posts.indexPost', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $title = 'Добавить публикацию';

        $categories = Category::all();

        $groups = Group::all();

        $conferences = Conference::all();

        return view('admin.posts.formPost', compact('title', 'categories', 'groups', 'conferences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'content' => 'required'
        ]);

        $ThumbnailPost = null;

        if ($request->thumbnail) {
            $ThumbnailPost = time().'.'.$request->file('thumbnail')->extension();
            $request->thumbnail->storeAs('public/posts/', $ThumbnailPost);
        }

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'thumbnail' => $ThumbnailPost,
            'youtube' => $request->youtube,
            'rutube' => $request->rutube,
            'dzen' => $request->dzen,
            'category_id' => $request->category,
            'group_id' => $request->group,
            'conference_id' => $request->conference,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Публикация добавлена!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $title = 'Редактировать публикацию '.$post->name;

        $categories = Category::all();

        $groups = Group::all();

        $conferences = Conference::all();

        return view('admin.posts.editPost', compact('title', 'post', 'categories', 'groups', 'conferences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'content' => 'required'
        ]);

        $ThumbnailPost = null;

        if ($request->thumbnail) {
            $ThumbnailPost = time().'.'.$request->file('thumbnail')->extension();
            $request->thumbnail->storeAs('public/posts/', $ThumbnailPost);

            //delete old photo
            $path = storage_path('app/public/posts/'.$post->thumbnail);
            if (File::exists($path)) {
                File::delete($path);
            }

            $post->thumbnail = $ThumbnailPost;
        }

            $post->title = $request->title;
            $post->slug = Str::slug($request->title);
            $post->description = $request->description;
            $post->content = $request->content;
            $post->youtube = $request->youtube;
            $post->rutube = $request->rutube;
            $post->dzen = $request->dzen;

            $post->update();

        return redirect()->route('posts.index')->with('success', 'Публикация изменена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            //delete old photo
            $path = storage_path('app/public/posts/'.$post->thumbnail);
            if (File::exists($path)) {
                File::delete($path);
            }

            $post->deleteOrFail();

            return redirect()->route('posts.index')->with('danger', 'Публикация удалена!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
