<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);

        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    public function deletePost(Post $post)
    {
        if (auth()->user()->id === $post->user_id) {
            $post->delete();
            return redirect('/')->with('success', 'Post deleted successfully!');
        }
        
        return redirect('/')->with('error', 'You are not authorized to delete this post.');
    } 

    public function index()
    {
        $posts = Post::orderBy('created_at','asc')->get();
        return view('pages.dashboards.index', compact('posts'));
    }
    

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('title', 'like', "%$search%")->get();

        return view('pages.dashboards.index', compact('posts', 'search'));
    }
}
