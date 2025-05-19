<x-layout>
    <div class=" my-4 container mx-auto">
        <div class="flex gap-4 items-center my-4">
            <a href="{{ route('posts.create') }}">
                <button class=" rounded-xl bg-blue-600 py-2 px-4 font-black uppercase text-white">
                    create post
                </button>
            </a>
        </div>
        <div class="flex items-center gap-3 flex-col">
            @foreach ($posts as $post)
                <x-post :post="$post" />
            @endforeach
        </div>
    </div>
</x-layout>