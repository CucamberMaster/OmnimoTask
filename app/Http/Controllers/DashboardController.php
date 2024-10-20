<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {

        $posts = Post::with('comments.user')
        ->where('user_id', Auth::id())
            ->get();

        return view('dashboard', compact('posts'));
    }
}
