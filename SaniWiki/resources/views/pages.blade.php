@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/pages.css') }}"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
@section('content')
        <style>.backbar{background-image: url("{{asset('/images/posts/'.$category->bgImage)}}")}</style>
        <div class="backbar">
            <div class="shadow-bg">
                <h1>{{$category->name}}</h1>
            </div>

        </div>


    <div class="container table-responsive">
        @if((\Auth::user()->isInGroup(3)) || (\Auth::user()->isInGroup(2)))
            <button class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#myModal" href="#">Inserisci nuovo articolo</button>
        @endif
        @if (count($posts) > 0)
        <table id="postsTable" class="table">
            <thead>
                <th scope="col"></th>
                <th scope="col"></th>
            </thead>
            <tbody>
            @foreach ($posts as $post)
            <tr>
                <td scope="row"><a href="{{asset('/post/'.$post->id)}}">{{$post->title}}</a></td>
                @if((\Auth::user()->isInGroup(3)) || (\Auth::user()->isInGroup(2)))
                <td scope="row">
                    <button class="btn btn-danger adminListTools" onClick="postDelete({{$post->id}})" data-postid={{$post->id}} data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                    <button class="btn btn-primary adminListTools edit" onclick="location.href='{{asset('/postEdit/'.$post->id)}}';" onClick="postEdit({{$post->id}})" data-postid={{$post->id}} data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                </td>
                @else
                <td scope="row"></td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
            @else
                <p>Non sono presenti posts.</p>
            @endif
    </div>



        <!-- Modal Insert Post -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <form action="{{URL::asset('addPost/'.$categoryId)}}" method="post" class="form-group">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi un nuovo articolo</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    Sono presenti alcuni errori nel formulario
                                </div>
                            @endif
                            <section id="newCategoryInfo">
                                <h4>Informazioni articolo</h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="categoryName-label">Nome</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Titolo post"
                                           aria-label="Title" aria-describedby="postTitle-label"
                                           name="title" value="{{old('title')}}" required>
                                </div>
                            </section>
                        </div>
                        <div class="modal-footer">
                            @if($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Chiudi
                            </button>
                            <button type="submit" class="btn btn-primary" id="save">Salva</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->


        <!-- Modal Delete -->
        <div class="modal fade" id="delete" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{route('post.destroy', 'delete')}}" method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <div class="modal-header">
                            <h4 class="modal-title text-center">Eliminazione articolo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                        </div>
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                            <p>Sei sicuro di voler eliminare questo articolo?</p>
                            <p class="danger">Attenzione operazione irreversibile!<br> Una volta confermato non sarà
                                possibile ripristinare i dati.</p>
                            <input type="hidden" name="post_id" id="post_id" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">No, chiudi</button>
                            <button type="submit" class="btn btn-primary">Si, elimina</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--- end delete modal -->

        <!-- add script for modal-->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" defer></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js" defer></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="{{URL::asset('js/search.js')}}"></script>
        <script src="{{URL::asset('js/pagesModal.js')}}"></script>
@endsection