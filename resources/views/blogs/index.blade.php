@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h3>Total : {{ $blogs->count() }}</h3>
            </div>
            <div class="col-md-4">
                <a href="{{ route('blog.create') }}" class="btn btn-link float-right">+ {{ __('blog.new_blog') }}</a>
            </div>
        </div>
        @foreach($blogs as $blog)
            <div class="media">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0">{{ $blog->getLang->title }}</h5>
                    {!! $blog->getLang->description !!}
                    <br>
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <a href="{{ route('blog.edit', [$blog,'lang'=> config('app.locale')]) }}" class="btn btn-link">Edit</a>
                        <a href="" class="btn btn-link">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

