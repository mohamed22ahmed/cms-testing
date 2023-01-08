<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('comments.create') }}">Create Comment</a>
                    </div>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>#</th>
                            <th>Comment</th>
                            <th>Post Title</th>
                            <th>Post Body</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @if ($comments->count() == 0)
                                <tr>
                                    <td colspan="5">No products to display.</td>
                                </tr>
                            @endif
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->post->title ?? '' }}</td>
                                    <td>{{ $comment->post->body ?? '' }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('comments.show', $comment->id) }}">View</a>
                                        <a class="btn btn-sm btn-success" href="{{ route('comments.edit', $comment->id) }}">Edit</a>

                                        <form style="display:inline-block" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger"> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $comments->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
