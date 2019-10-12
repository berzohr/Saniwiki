@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/post.css') }}"/>
<link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">

@section('content')
    <style>.backbar {
            background-image: url("{{asset('/images/posts/'.$category->bgImage)}}")
        }</style>
    <form action="{{URL::asset('postEdit')}}" method="post">
        {{method_field('post')}}
        {{csrf_field()}}
        <div class="backbar">
            <div class="shadow-bg">
                <div class="shadow backto">
                    <a href="{{asset('/pages/'.$category->id)}}"><i
                                class="fas fa-arrow-circle-left"></i> {{$category->name}}</a>
                </div>
                <div class="shadow-container">
                    <h1><input value="{{$posts->title}}" name="postTitle" placeholder="Post title" required></h1>
                </div>
            </div>
        </div>
        <div class="container" id="postContent">
            <input class="form-control hidden" type="hidden" name="postTitleID" value="{{$posts->id}}">
            <div class="row">
                {{--<form action="{{URL::asset('postEdit')}}" method="post">--}}

                <input class="form-control hidden" type="hidden" name="postId" value="{{$posts->id}}">
                @php
                    $index = 0
                @endphp
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
                            <div class="sectionBody">
                                @foreach($sections_post as $section_post)
                                    @if ($section_post->section === $section->id)
                                        @php
                                            ++$index
                                        @endphp
                                        <div class="panel-body">
                                            <textarea class="description"
                                                      name="sections[section{{$index}}][body] ">{{$section_post->body}}</textarea>
                                            <input class="form-control hidden" type="hidden"
                                                   name="sections[section{{$index}}][id]" value="{{$section_post->id}}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </header>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary hide" id="save">Salva</button>
                {{--</form>--}}
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $('.description').summernote({
                popatmouse: false,
                height: 300
            });
        });
    </script>
@endsection
