@extends('layout')

    @section('title')
       Home Page
    @endsection

    @section('contents')
        @foreach ($posts as $post)
            <article>
                <h1>
                    <a href="posts/{{$post->name}}">
                            {{$post->title}}
                    </a>
                </h1>
                <div>
                        {!! $post->body !!}
                </div>

            </article>

        @endforeach
    @endsection
