<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card p-4">
                    <div class="row">
                        <div class="text-right">
                            <a class="btn btn-primary" href="{{ route('posts.index') }}">Index</a>
                            <a class="btn btn-success" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2"># </div>
                        <div class="col-md-6">{{ $post->id }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2">Title: </div>
                        <div class="col-md-6">{{ $post->title }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2">Body: </div>
                        <div class="col-md-6">{{ $post->body }}</div>
                    </div>

                    <div class="row card mb-2 mt-4">
                            <div class="card-head text-xl">
                                User
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-2">Name: </div>
                                    <div class="col-md-6">{{ $post->user->name }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-2">Email: </div>
                                    <div class="col-md-6">{{ $post->user->email }}</div>
                                </div>
                            </div>
                        </div>

                    @if($post->comments->count())
                        <div class="row card mb-2">
                            <div class="card-head text-xl">
                                Comments
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Comment</th>
                                    </thead>
                                    <tbody>
                                        @if ($post->comments->count() == 0)
                                            <tr>
                                                <td colspan="5">No Comments to display.</td>
                                            </tr>
                                        @endif
                                        @foreach ($post->comments as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td>{{ $comment->comment }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
