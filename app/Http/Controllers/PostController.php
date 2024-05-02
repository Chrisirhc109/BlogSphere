<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        // Validate the incoming fields
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg',
        ]);
    
        // Handle image upload if present
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'upload/post/';
            $file->move($path, $filename);
    
            // Add the image filename to the validated data
            $validatedData['image'] = $path . $filename;
        }
    
        // Strip HTML tags from title and body
        $validatedData['title'] = strip_tags($validatedData['title']);
        $validatedData['body'] = strip_tags($validatedData['body']);
    
        // Assign the authenticated user's ID to the user_id field
        $validatedData['user_id'] = auth()->id();
    
        // Create a new post
        Post::create($validatedData);
    
        // Redirect back to the homepage with a success message
        return redirect()->back()->with('success', 'Post created successfully!');
    }
    

    
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg',
        ]);
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'upload/post/';
            $file->move($path, $filename);
    
            // Delete the previous image file if it exists
            if (File::exists($post->image)) {
                File::delete($post->image);
            }
    
            // Update the image path in the post model
            $post->image = $path . $filename;
        }
    
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
    
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

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('title', 'like', "%$search%")
                    ->orWhere('body','like',"%$search%")
                    ->get();

        return view('pages.dashboards.index', compact('posts', 'search'));
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('pages.dashboards.index', compact('posts'));
    }
}
