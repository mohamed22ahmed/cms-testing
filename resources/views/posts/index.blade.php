<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('posts.create') }}">Create Post</a>
                    </div>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Owner</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @if ($posts->count() == 0)
                                <tr>
                                    <td colspan="5">No Posts to display.</td>
                                </tr>
                            @endif
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}">View</a>
                                        @if($post->user->id == auth()->user()->id || auth()->user()->is_admin)
                                            <a class="btn btn-sm btn-success" href="{{ route('posts.edit', $post->id) }}">Edit</a>

                                            <form style="display:inline-block" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-danger"> Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $posts->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
