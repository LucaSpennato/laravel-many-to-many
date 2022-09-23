<div class="card mt-5 p-1 col-3 mx-2">
    <img src="{{ $post->post_image }}" class="card-img-top" alt="{{ $post->title }}'s image">
    <div class="card-body">

        <h6 class="card-subtitle text-success mb-3">
            {{-- ? Essendo presente più di un tag, vanno ciclati --}}
            <div>
                Tags:
            </div>
            @forelse ($post->tags as $tag)
                <a href="{{ route('admin.tags.show', $tag->id) }}">{{ $tag->name }} |</a>
            @empty
                No tags
            @endforelse
        </h6>

        <h5 class="card-subtitle">
            Author id:
            {{ $post->user_id }}
        </h5>
        <h5 class="card-subtitle">
            Author name:
            <a href="{{ $post->user->name }}">{{ $post->user->name }}</a>
        </h5>
        <h5 class="card-title">
            Title:
            {{ $post->title }}
        </h5>

        <p class="card-subtitle">
            Published:
            {{ $post->post_date }}
        </p>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary">Show</a>
        </div>
    </div>
</div>
