@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{route('posts')}}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4"
                              class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror"
                              placeholder="Post something !">{{@old('password')}}</textarea>
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <input type="submit" value="Post"
                           class="bg-blue-500 text-white px-4 py-2 rounded font-medium w-full"/>
                </div>
            </form>
            @if ($posts->count())
                @foreach($posts as $post)
                    <div class="mb-4 mt-4">
                        <a href="" class="font-bold">{{$post->user->name}}</a> <span
                            class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
                        <p class="mb-2">{{$post->body}}</p>
                        @can('delete', $post)
                            <form action="{{route('posts.destroy', $post)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-blue-500">Delete</button>
                            </form>
                        @endcan
                        <div class="flex items-center">
                            @auth()
                                @if (!$post->likedBy(auth()->user()))
                                    <form action="{{route('posts.likes', $post->id)}}" method="post" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-blue-500">Like</button>
                                    </form>
                                @else
                                    <form action="{{route('posts.likes', $post->id)}}" method="post" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Unlike</button>
                                    </form>
                                @endif
                            @endauth
                            <span>
                                {{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}}
                            </span>
                        </div>
                    </div>
                @endforeach
                {{$posts->links()}}
            @else
                <p class="mt-4">There are no posts</p>
            @endif
        </div>
    </div>
@endsection
