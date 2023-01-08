<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card p-4">
                    <div class="row">
                        <div class="text-right">
                            <a class="btn btn-primary" href="{{ route('comments.index') }}">Index</a>
                            <a class="btn btn-success" href="{{ route('comments.edit', $comment->id) }}">Edit</a>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2"># </div>
                        <div class="col-md-6">{{ $comment->id }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2">Comment: </div>
                        <div class="col-md-6">{{ $comment->comment }}</div>
                    </div>
                    @if($comment->post->count() >0)
                        <div class="row card mb-2 mt-4">
                            <div class="card-head text-xl">
                                Post
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-2">Title: </div>
                                    <div class="col-md-6">{{ $comment->post->title }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-2">Body: </div>
                                    <div class="col-md-6">{{ $comment->post->body }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
