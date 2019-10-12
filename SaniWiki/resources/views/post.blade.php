@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/post.css') }}"/>
<link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">

@section('content')
    <style>.backbar{background-image: url("{{asset('/images/posts/'.$category->bgImage)}}")}</style>
    <div class="backbar">
        <div class="shadow-bg">
            <div class="shadow backto">
                <a href="{{asset('/pages/'.$category->id)}}"><i class="fas fa-arrow-circle-left"></i>  {{$category->name}}</a>
            </div>
            <div class="shadow-container">
                <h1>{{$posts->title}}</h1>
            </div>
        </div>
    </div>
    <div class="container" id="postContent">
        <div class="row">
            @foreach ($sections as $section)
                <div class="col-md-12">
                    <header class="sectionHead">
                        @if($section->isIconURL == 1)
                            <img class="section-image" src="{{URL::asset($section->iconURL)}}"
                                 alt="{{$section->name}} icon"
                                 class="section-icon">
                        @else
                            <i class="section-image {{$section->iconFontAw}} fa-2x"></i>
                        @endif
                        <h2>{{$section->name}}</h2>
                    </header>
                    <div class="sectionBody">
                        @foreach($sections_post as $section_post)
                            @if ($section_post->section === $section->id)
                                {!! $section_post->body !!}
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @if((\Auth::user()->isInGroup(3)) || (\Auth::user()->isInGroup(2)))
        <div class="lastChange">
            <p>Articolo creato in data: <span>{{$posts->created_at}}</span></p>
            <p>Ultima modifica eseguita da <span>{{$posts->author}}</span> in data: <span>{{$posts->updated_at}}</span></p>
        </div>
        @endif
    </div>
    <script src="{{URL::asset('js/sticky.js')}}"></script>
@endsection
