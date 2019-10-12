@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/changePassword.css') }}"/>
<link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
@section('content')
    <div class="mainForm">
    <h3>Modifica Password</h3>
    <div class="changePasswordForm">
        <form action="{{route('user.password.update', $user->id)}}" method="post" class="form-group" oninput="checkPasswordMatches()">
            @method('PATCH')
            @csrf
            <div class="password">
                <p>Inserisci una nuova password</p>
                <input id="p1" type="password" name="p1" value="" required />
            </div>
            <div class="confirm">
                <p>Reinserisci la password per confermare</p>
                <input id="p2" type="password" name="p2" value="" oninput="result.value=!!p2.value&&(p1.value==p2.value)?'OK! Cliccare su Salva per confermare':'Password non uguali'" required />
            </div>
            <div class="result">
                <output id="result" name="result"></output>
            </div>
            <button type="submit" class="btn btn-primary" id="save" disabled>Salva</button>
        </form>
    </div>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <script src="{{URL::asset('js/changePassword.js')}}"></script>
@endsection