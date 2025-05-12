<x-layout>
    <div class=" container mx-auto my-4">
        <a href="{{ route('home') }}" class=" underline">Go back</a>
        <h1 class=" text-2xl">Create new post</h1>
        @if ($errors->any())
            <div class=" text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class=" grid gap-2">
            @csrf
            <div class="grid">
                <label for="text_input">post text</label>
                <textarea name="text" id="text_input" placeholder="post text"
                    class="w-96 border p-2 rounded"></textarea>
            </div>
            <div class="grid">
                <label for="image_input">image</label>
                <input type="file" name="image" id="image_input" class="border p-2 rounded w-56">
            </div>
            <div>
                <button class="rounded-xl bg-blue-600 py-2 px-4 font-black uppercase text-white">
                    Upload
                </button>
            </div>
        </form>
    </div>
</x-layout>