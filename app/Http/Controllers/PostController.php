<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $sort = $request->get('sort');

        if ($sort === 'comments') {
            $posts = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->get();
        } else {
            $posts = Post::orderBy('created_at', 'desc')->get();
        }

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);


        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);


        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    public function show($id)
    {
        $post = Post::with('comments.user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect('/posts/'.$id);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted successfully!');
    }
}
