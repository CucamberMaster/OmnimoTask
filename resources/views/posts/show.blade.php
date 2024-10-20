@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">{{ $post->title }}</h1>
        <p class="mb-4">{{ $post->content }}</p>

        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mb-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Delete Post</button>
            </form>
        @endcan

        <h3 class="mt-6">Comments</h3>
        @foreach ($post->comments as $comment)
            <div class="mb-4 p-2 border border-gray-300 rounded-md">
                <p>{{ $comment->comment }}</p>
                <p class="text-sm text-gray-500">By {{ $comment->user->name }} on {{ $comment->created_at }}</p>

                @can('delete', $comment)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded-md hover:bg-red-600">Delete Comment</button>
                    </form>
                @endcan
            </div>
        @endforeach

        @auth
            <form method="POST" action="/posts/{{ $post->id }}/comments">
                @csrf
                <textarea name="comment" placeholder="Leave a comment" class="w-full px-4 py-2 border border-gray-300 rounded-md"></textarea>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Comment</button>
            </form>
        @endauth
    </div>
@endsection
