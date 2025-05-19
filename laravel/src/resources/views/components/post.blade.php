<div class="bg-slate-300 p-4 rounded-lg w-96">
    <div class=" flex justify-between mb-4">
        <span class="flex items-center gap-2">
            {{ $post->text }}
            @if ($post->hasString('mvc'))
                <x-icons.success />
            @endif
        </span>
        <!-- delete button -->
        <form action="{{ route('posts.delete', $post->id) }}" onsubmit="return confirm('are you sure')" method="POST">
            @method("delete")
            @csrf
            <input type="hidden" value="{{ $post->id }}">
            <button class="rounded-full bg-red-700 p-2 font-black uppercase text-white">
                <x-icons.trash />
            </button>
        </form>
    </div>
    <img class="rounded-lg mx-auto" src="{{ asset("/storage/$post->image") }}" alt="">
</div>