@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h3>Edit Blog</h3>
            </div>
            <div class="col-md-4">
                <a href="{{ route('blog.index') }}" class="btn btn-link float-right"> {{ __('blog.all_blog') }}</a>
            </div>
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach((new \App\Helpers\LocalizationHelper())->getAllLanguages() as $key=>$lang)
                <li class="nav-item">
                    <a class="nav-link {{ request()->query('lang') == $lang ? 'active' : '' }}" href="{{ route('blog.edit',[$blog,'lang'=> $lang]) }}"
                       style="text-transform: uppercase">{{ $lang }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content" id="myTabContent">


            <div class="tab-pane fade show active" role="tabpanel">
                <form action="{{ route('blog.update',[$blog]) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="lang" value="{{ request()->query('lang') }}" class="d-none">
                    <div class="form-group">
                        <label for="">{{ __('blog.title') }}</label>
                        <input type="text" class="form-control" name="title" value="{{ $blog->getLangByUrl ? $blog->getLangByUrl->title : '' }}"
                               placeholder="{{ __('blog.title') }}">
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('blog.slug') }}</label>
                        <input type="text" class="form-control" name="slug" value="{{ $blog->getLangByUrl ? $blog->getLangByUrl->slug : '' }}" placeholder="{{ __('blog.slug') }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('blog.description') }}</label>
                        <textarea name="description" placeholder="{{ __('blog.description') }}" id="" cols="30" rows="10"
                                  class="form-control">{{ $blog->getLangByUrl ? $blog->getLangByUrl->description : '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>

    </div>
@endsection

