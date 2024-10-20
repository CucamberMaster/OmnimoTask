@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center text-primary">All Posts</h1>

        <div class="mb-4 text-center">
            <span>Sort by:</span>
            <a href="{{ route('posts.index', ['sort' => 'created_at']) }}" class="btn btn-secondary btn-sm mx-1">Date Created</a>
            <a href="{{ route('posts.index', ['sort' => 'comments']) }}" class="btn btn-secondary btn-sm mx-1">Most Comments</a>
        </div>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden"
                         style="border-left: 5px solid #007bff;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title text-success">
                                    <a href="{{ url('posts/' . $post->id) }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                                </h5>
                                <p class="card-text text-muted">By <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->format('M d, Y') }}</p>
                                <p class="card-text">
                                    <span class="badge bg-info text-dark">{{ $post->comments->count() }} Comment{{ $post->comments->count() !== 1 ? 's' : '' }}</span>
                                </p>
                            </div>
                            <div class="mt-3">
                                @if (Auth::check() && Auth::user()->id === $post->user_id)
                                    <div class="text-end">
                                        <a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-warning btn-sm">Update</a>
                                        <form action="{{ url('posts/' . $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ url('posts/' . $post->id) }}" class="btn btn-primary mt-2">Read More</a>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">Last updated {{ $post->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .badge {
            font-weight: bold;
        }
    </style>
@endsection
