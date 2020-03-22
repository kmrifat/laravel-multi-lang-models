@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h3>Create New Blog</h3>
            </div>
            <div class="col-md-4">
                <a href="{{ route('blog.index') }}" class="btn btn-link float-right"> {{ __('blog.all_blog') }}</a>
            </div>
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach((new \App\Helpers\LocalizationHelper())->getAllLanguages() as $key=>$lang)
                <li class="nav-item">
                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $lang }}-{{ $key }}" data-toggle="tab" href="#{{ $lang }}" role="tab" aria-controls="home"
                       aria-selected="true" style="text-transform: uppercase">{{ $lang }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content" id="myTabContent">

            @foreach((new \App\Helpers\LocalizationHelper())->getAllLanguages() as $key=>$lang)

                <div class="tab-pane fade {{ $lang == 'en' ? 'show active' : '' }}" id="{{ $lang }}" role="tabpanel" aria-labelledby="{{ $lang }}-{{ $key }}">
                    <form action="{{ route('blog.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="lang" value="{{ $lang }}" class="d-none">
                        <div class="form-group">
                            <label for="">{{ __('blog.title') }}</label>
                            <input type="text" class="form-control" name="title" placeholder="{{ __('blog.title') }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('blog.slug') }}</label>
                            <input type="text" class="form-control" name="slug" placeholder="{{ __('blog.slug') }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('blog.thumbnail') }}</label>
                            <input type="file" accept="image/*" name="thumbnail" class="form-control" placeholder="{{ __('blog.thumbnail') }}">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('blog.description') }}</label>
                            <textarea name="description" placeholder="{{ __('blog.description') }}" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            @endforeach
        </div>

    </div>
@endsection

