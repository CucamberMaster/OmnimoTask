@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Edit Post: {{ $post->title }}</h1>
        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-300 mb-2">Post Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $post->title) }}"
                    placeholder="Enter post title"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                >
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 dark:text-gray-300 mb-2">Post Content</label>
                <textarea
                    name="content"
                    id="content"
                    placeholder="Enter post content"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                    rows="6"
                >{{ old('content', $post->content) }}</textarea>
            </div>
            <button
                type="submit"
                class="w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 transition duration-200"
            >
                Update Post
            </button>
        </form>
    </div>
@endsection
