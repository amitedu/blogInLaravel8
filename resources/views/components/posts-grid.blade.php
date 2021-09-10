@props(['posts'])
<div>
    <x-post-featured :post="$posts[0]"></x-post-featured>

    @if ($posts->count() > 1)
        <div class="lg:grid lg:grid-cols-6">
            @foreach ($posts->skip(1) as $post)
                <x-post-card :post="$post" class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"></x-post-card>
            @endforeach
        </div>

    @endif
</div>
