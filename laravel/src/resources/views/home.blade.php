<x-layout>
    <div class=" my-4 container mx-auto">
        <a href="{{ route('posts.create') }}">
            <button class=" rounded-xl bg-blue-600 py-2 px-4 font-black uppercase text-white">
                create post
            </button>
        </a>
        <div class="flex items-center gap-3 flex-col">
            @foreach ($posts as $post)
            <div class="bg-slate-300 p-4 rounded-lg w-96">
                {{ $post->text }}
                <img class="rounded-lg mx-auto" src="{{ asset("/storage/$post->image") }}" alt="">
            </div>
            @endforeach
        </div>
    </div>
</x-layout>