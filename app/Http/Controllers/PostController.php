<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4000'],
        ]);
        if ($request->hasFile('image')) {
            $fields['image'] = Storage::disk('public')->put('/images', $request->file('image'));
        }
        AUTH::user()->posts()->create($fields);
        return back()->with('success', 'Post created successfully');
    }

    public function show(Post $post) {
        if (Auth::check()) {
            if ($post->user_id == Auth::user()->id) {
                return view('one_post', ['post' => $post]);
            } else {
                $post = Post::find($post->id);
                return view('one_post', ['post' => $post]);
            }
        }
    }
    public function getAll($user_name = null, $user_id = null) {
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

        Gate::authorize('Modify', $post);
        $formFields = [
            [
                'id' => 'title',
                'name' => 'title',
                'type' => 'text',
                'label' => 'Enter The Title',
                'help' => '',
                'helpText' => '',
                'value' => $post->title
            ],
            [
                'id' => 'content',
                'name' => 'body',
                'type' => 'text',
                'label' => 'Enter The Content',
                'help' => '',
                'helpText' => '',
                'value' => $post->body
            ],
        ];
        $route = route('posts.update', $post->id);
        $submit_button = 'Update';
        return view('edit_post', ['post' => $post, 'formFields' => $formFields, 'route' => $route, 'submit_button' => $submit_button]);
    }

    public function update(Request $request, Post $post) {
        Gate::authorize('Modify', $post);
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
        ]);
        $post->update($fields);
        return \redirect()->route('dashboard')->with('success', 'Post updated successfully');
    }
    public function destroy(Post $post) {
        Gate::authorize('Modify', $post);
        $post->delete();
        return back()->with('delete', 'Post deleted successfully');
    }
}
