@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    @if (session('success'))
                        <div class="mt-4 p-4 bg-green-200 text-green-800 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-end mb-2 mt-2">
                <a href="{{ route('posts.create') }}" class="btn btn-success bg-green-700 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
                    Create New Post
                </a>
            </div>

            <div class="mt-6">
                <h1 class="mb-4">My Posts</h1>
                @if ($posts->isEmpty())
                    <p>No posts found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                            <thead>
                                <tr class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <th class="py-2 px-4 border-b text-center">Title</th>
                                    <th class="py-2 px-4 border-b text-center">Description</th>
                                    <th class="py-2 px-4 border-b text-center">Comments</th>
                                    <th class="py-2 px-4 border-b text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="py-2 px-4 border-b text-center">{{ $post->title }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $post->content }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            @if ($post->comments->isEmpty())
                                                <p class="text-gray-600">No comments</p>
                                            @else
                                                <ul class="list-disc pl-5">
                                                    @foreach ($post->comments as $comment)
                                                        <li class="text-gray-800">{{ $comment->content }} - <strong>{{ $comment->user->name }}</strong></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn p-1  m-1 btn-warning bg-blue-700 btn-sm">Edit</a>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger m-1 p-1 bg-red-700 btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
