<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, $postId) {
        $request->validate(['comment' => 'required']);

        $post = Post::findOrFail($postId);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect('/posts/' . $postId);
    }

    public function destroy($id) {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
