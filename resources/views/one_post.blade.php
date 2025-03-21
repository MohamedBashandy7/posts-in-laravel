<x-layout title="{{ env('APP_NAME') }}">
    <x-header />
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{$post->body }}</p>
                @if (request()->routeIs('dashboard'))
                    <p class="card-text"><small class="text-muted">Posted on {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</small></p>
                @else
                    <p class="card-text"><small class="text-muted">Posted on {{ $post->created_at->diffForHumans() }} by <a class="text-decoration-none" href="{{ route('show user post', ['user_name' => $post->user->name, 'user_id' => $post->user_id]) }}">{{ $post->user->name }}</a></small></p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
