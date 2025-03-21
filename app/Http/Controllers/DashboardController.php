<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;

class DashboardController extends Controller {
    public function index() {
        $postController = new PostController(); // Create an instance of PostController
        $posts = $postController->getAll(); // Call the show method to get posts
        $formFields = [
            [
                'id' => 'title',
                'name' => 'title',
                'type' => 'text',
                'label' => 'Enter The Title',
                'help' => '',
                'helpText' => ''
            ],
            [
                'id' => 'content',
                'name' => 'body',
                'type' => 'text',
                'label' => 'Enter The Content',
                'help' => '',
                'helpText' => ''
            ],
        ];
        $route = route('posts.store');
        $submit_button = 'Create';
        return view('users.dashboard', compact('formFields', 'route', 'submit_button', 'posts'));
    }

    public function store(Request $request) {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
