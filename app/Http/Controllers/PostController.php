<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    public function index() {
        $posts = Post::latest()->paginate(6);
        return view('index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
        ]);
        AUTH::user()->posts()->create($fields);
        return back()->with('success', 'Post created successfully');
    }

    public function show($user_name = null, $user_id = null) {
        if (Auth::check()) {
            if ($user_id && $user_id != Auth::user()->id) {
                $MyPosts = Post::where('user_id', $user_id)->latest()->paginate(6);
                return view('index', ['posts' => $MyPosts, 'name' => $user_name]);
            } elseif ($user_id == Auth::user()->id) {
                return redirect()->route('dashboard');
            } else {
                return Auth::user()->posts()->latest()->paginate(6);
            }
        } else {
            if ($user_id) {
                $posts = Post::where('user_id', $user_id)->latest()->paginate(6);
                return view('index', ['posts' => $posts, 'name' => $user_name]);
            } else {
                $posts = Post::latest()->paginate(6);
                return view('index', ['posts' => $posts, 'name' => '']);
            }
        }
    }


    public function edit(Post $post) {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdatePostRequest $request, Post $post) {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {
        //
    }
}
