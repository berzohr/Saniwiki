@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
<link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">

@section('content')
    <div class="container">
        @if (count($categories) > 0)
            <div>
                <form method="GET" action="{{ url('search') }}">
                    <div class="row">
                        <div class="col-md-12 input-group">
                            <input type="text" name="search" class="form-control" placeholder="Ricerca per...">
                            <button class="btn btn-primary">Ricerca</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-3">
                        <div class="adminTools">
                            @if((\Auth::user()->isInGroup(3)) || (\Auth::user()->isInGroup(2)))

                                <button class="btn btn-primary edit" onClick="categoryEdit({{$category}})"
                                        data-catid={{$category->id}} data-toggle="modal" data-target="#edit"><i
                                            class="fas fa-edit"></i></button>
                                <button class="btn btn-danger trash-alt" onClick="categoryDelete({{$category->id}})"
                                        data-catid={{$category->id}} data-toggle="modal" data-target="#delete"><i
                                            class="fas fa-trash-alt"></i></button>

                            @endif
                        </div>
                        <a href="{{url('pages').'/'.$category->id}}" class="category_container">
                            <div class="category-card">
                                <div class="category-card-content">
                                    <div class="category-image"></div>
                                    @if ($category->isIconURL == 1)
                                        <img class="category-image" src="{{URL::asset($category->iconURL)}}"
                                             alt="{{$category->name}} icon">
                                    @else
                                        <i class="category-image-font {{$category->iconFontAw}} fa-6x"></i>
                                    @endif
                                </div>
                                <div class="category-card-title">
                                    <span>{{$category->name}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                @endif
                @if((\Auth::user()->isInGroup(3)) || (\Auth::user()->isInGroup(2)))

                    <div class="col-md-3">
                        <div class="adminTools"></div>
                        <a data-toggle="modal" data-target="#myModal" href="#" class="category_container">
                            <div class="category-card">
                                <div class="category-card-content add-category">
                                    <div class="category-image"></div>
                                    {{--<img class="category-image" src="{{URL::asset('images/categories/aggiungi.png')}}"--}}
                                    {{--alt="aggiungi icon">--}}
                                    <i class="category-image-font fas fa-plus fa-5x"></i>
                                </div>
                                <div class="category-card-title">
                                    <span>Aggiungi categoria</span>
                                </div>
                            </div>
                        </a>
                    </div>
            @endif
            <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{URL::asset('addCategory')}}" method="post" class="form-group" id="newCat">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Aggiungi nuova categoria</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    {{--<form action="/addCategory" method="post" class="form-group">--}}
                                    {{--@csrf--}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            Sono presenti alcuni errori nel formulario
                                        </div>
                                    @endif
                                    <section id="newCategoryInfo">
                                        <h4>Informazioni categoria</h4>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="categoryName-label">Nome</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nome categoria"
                                                   aria-label="Name" aria-describedby="categoryName-label"
                                                   name="name" value="{{old('name')}}" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="categoryOrder-label">Ordine</span>
                                            </div>
                                            <select class="form-control" aria-label="Order"
                                                    aria-describedby="categoryOrder-label" name="type" required>
                                                <option value="" selected disabled>Seleziona un ordine di
                                                    visualizzazione
                                                </option>
                                                <option value=1>Nomi dalla A-Z</option>
                                                <option value=2>Dal più recente</option>
                                                <option value=3>Dal più vecchio</option>
                                            </select>
                                        </div>
                                        <!-- add icon picker input -->
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span>Icona&nbsp;</span> <span class="input-group-addon"></span>
                                                </div>
                                            </div>
                                            <input data-placement="bottomRight"
                                                   class="form-control icp icp-auto icon-picker" value="fas fa-question"
                                                   type="text" name="categoryIcon" required/>
                                        </div>

                                        {{--<input type="file" name="bgImage">--}}
                                        {{--<div class="input-group">--}}
                                            {{--<label class="input-group-btn">--}}
                                                {{--<span class="btn btn-primary">Seleziona uno sfondo&hellip;--}}
                                                    {{--<input type="file" style="display: none;" name="bgImage"multiple>--}}
                                                {{--</span>--}}
                                            {{--</label>--}}
                                            {{--<input type="text" class="form-control" readonly>--}}
                                        {{--</div>--}}
                                    </section>
                                    <section id="addSections" class="hide">
                                        <h4>Creazione del template</h4>
                                        <section id="newSections">
                                            <div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                      id="sectionName1-label">Nome</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Nome sezione"
                                                           aria-label="Name" aria-describedby="sectionName1-label"
                                                           name="sections[section1][name]" required>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span>Icona&nbsp;</span> <span
                                                                    class="input-group-addon"></span>
                                                        </div>
                                                    </div>
                                                    <input data-placement="bottomRight" id="sectionImage1"
                                                           class="form-control icp icp-auto icon-picker"
                                                           value="fas fa-question" type="text"
                                                           name="sections[section1][icon]" required/>
                                                </div>
                                            </div>
                                            <hr>
                                        </section>
                                        <button type="button" class="btn btn-default btn-lg" id="addNewSection">
                                            <i class="fas fa-plus"></i> Aggiungi sezione
                                        </button>
                                    </section>
                                    {{--<button type="submit" class="btn btn-primary hide" id="save">Salva</button>--}}
                                    {{--</form>--}}
                                </div>
                                <div class="modal-footer">
                                    @if($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">
                                        Chiudi
                                    </button>
                                    <button type="button" class="btn btn-primary" id="next">Avanti</button>
                                    <button type="submit" class="btn btn-primary hide" id="save">Salva</button>
                                </div>
                            </form>
                        </div>
                        <!-- add script for modal-->
                        <script src="{{URL::asset('js/homeModal.js')}}"></script>
                    </div>
                </div>
                <!-- end modal -->
            </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{route('category.destroy', 'delete')}}" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Eliminazione categoria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p>Sei sicuro di voler eliminare questa categoria, tutte le sezioni e i relativi articoli?</p>
                        <p class="danger">Attenzione operazione irreversibile!<br> Una volta confermato non sarà
                            possibile ripristinare i dati.</p>
                        <input type="hidden" name="category_id" id="cat_id" value="">
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

    <!-- Modal Edit-->
    <div class="modal fade" id="edit" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{URL::asset('editCategory')}}" method="post" class="form-group">
                    @csrf
                    <div id="categoryEditor">
                        <!-- dynamic content from JS -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end edit modal -->

    <!-- Script init icon-picker -->
    <script>
        jQuery(document).ready(function ($) {
            $(function () {
                $('.icon-picker').iconpicker();
            });
        });
    </script>
@endsection
