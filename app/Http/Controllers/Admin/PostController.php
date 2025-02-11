<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::with('user')->get();
        return view('admin.posts.all', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Post::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);
        return to_route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * search the specified resource from db.
     */
    public function search(Request $request)
    {
        //
        $query = $request->input('query');
        $filter = $request->input('filter');
        $posts = Post::with('user')
            ->search($query)  // Apply Search Scope
            ->filterByStatus($filter) // Apply Filter Scope;
            ->get();

        return response()->json($posts);
    }
}
