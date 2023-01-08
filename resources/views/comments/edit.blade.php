<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card p-4">
                    <form action="{{ route('comments.update', $comment->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select class="form-select" name="post_id">
                                <option disabled>Select a post to comment on</option>
                                @foreach($posts as $post)
                                    <option {{ $post->id == $comment->post_id ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <input type="text" class="form-control" value="{{ $comment->comment }}" id="comment" name="comment" required>
                        </div>

                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
