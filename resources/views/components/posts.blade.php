<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4"> <!-- Adjust the column size as needed -->
            <div class="card mb-4">
                <div class="card-body">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
                    @endif
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::words($post->body, 30) }}</p>
                    @if (request()->routeIs('dashboard'))
                        <p class="card-text"><small class="text-muted">Posted on {{ $post->created_at->diffForHumans() }}
                                by {{ $post->user->name }}</small></p>
                    @else
                        <p class="card-text"><small class="text-muted">Posted on
                                {{ $post->created_at->diffForHumans() }}
                                by <a class="text-decoration-none"
                                    href="{{ route('show user post', ['user_name' => $post->user->name, 'user_id' => $post->user_id]) }}">{{ $post->user->name }}</a></small>
                        </p>
                    @endif
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary d-inline">Edit</a>
                    @if (request()->routeIs('dashboard'))
                        <form class="d-inline" action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
