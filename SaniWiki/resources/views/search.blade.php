@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
<link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
@section('content')
    <div class="container">
        <h1>Ricerca</h1>
        <form method="GET" action="{{ url('search') }}">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Ricerca">
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary">Ricerca</button>
                </div>
            </div>
        </form>
        <br/>
        <table class="table table-bordered">
            <tr>
                <th>Categoria</th>
                <th>Articolo</th>
                <th>Testo</th>
            </tr>
            @if (count($sectionsposts) > 0)
                @foreach ($sectionsposts as $sectionpost)
                <tr>
                    <td><a href="{{url('pages').'/'.$sectionpost->getSection->getCategory->id}}">{{ $sectionpost->getSection->getCategory->name }}</a></td>
                    <td><a href="{{asset('/post/'.$sectionpost->getPost->id)}}">{{ $sectionpost->getPost->title }}</a></td>
                    <td>{{ $sectionpost->body }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-danger">Nessun risultato trovato.</td>
                </tr>
            @endif
        </table>
    </div>
@endsection