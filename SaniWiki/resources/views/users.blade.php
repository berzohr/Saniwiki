@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/pages.css') }}"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link href="https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
@section('content')
    @if((\Auth::user()->isInGroup(3)))
        <style>.backbar{background-image: url("{{asset('/images/posts/adminUser-bg.jpg')}}")}</style>
        <div class="backbar">
            <div class="shadow-bg">
                <h1>Gestione utenti</h1>
            </div>
        </div>


        <div class="container table-responsive">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                <button class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#myModal" href="#">Aggiungi nuovo utente</button>
                @if (count($users) > 0)
                    <table id="usersTable" class="table display">
                        <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Permessi</th>
                        <th scope="col">Azioni</th>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row"><a>{{$user->id}}</a></th>
                                <td><a>{{$user->name}}</a></td>
                                <td><a>{{$user->email}}</a></td>
                                <td>
                                    @if ($user->accessGroup === 1)
                                        <a>Lettura</a>
                                    @elseif ($user->accessGroup === 2)
                                        <a>Lettura/Scrittura</a>
                                    @else
                                        <a>Amministratore</a>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary" onClick="userEdit('{{$user->id}}', '{{$user->name}}', '{{$user->email}}', '{{$user->password}}', '{{$user->accessGroup}}')" data-toggle="modal" data-userEditid={{$user->id}} data-target="#edit">Modifica</button>
                                    @if ((count($users) > 1) && (!\Auth::user()->isLastAdmin($user->accessGroup)))
                                        <button class="btn btn-danger" onClick="userDelete({{$user->id}})" data-toggle="modal" data-userid={{$user->id}} data-target="#delete">Elimina</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Non sono presenti utenti.</p>
                @endif
        </div>


        <!-- Modal Insert User -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <form action="{{URL::asset('addUser')}}" method="post" class="form-group">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi un nuovo utente</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    Sono presenti alcuni errori nel formulario
                                </div>
                            @endif
                            <section id="newUserInfo">
                                <h4>Informazioni utente</h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="userName-label">Nome</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome"
                                           aria-label="Name" aria-describedby="userName-label"
                                           name="name" value="{{old('name')}}" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="userEMail-label">E-Mail</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="EMail"
                                           aria-label="EMail" aria-describedby="userEMail-label"
                                           name="email" value="{{old('email')}}" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="userPassword-label">Password</span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password"
                                           aria-label="Password" aria-describedby="userPassword-label"
                                           name="password" value="{{old('password')}}" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="accessGroup-label">Permessi</span>
                                    </div>
                                    <select class="form-control" aria-label="AccessGroup"
                                            aria-describedby="accessGroup-label" name="accessGroup" required>
                                        <option value="" selected disabled>Seleziona il permesso
                                        </option>
                                        <option value=1>Lettura</option>
                                        <option value=2>Lettura/Scrittura</option>
                                        <option value=3>Amministratore</option>
                                    </select>
                                </div>
                            </section>
                        </div>
                        <div class="modal-footer">
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
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
        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('user.destroy', 'delete')}}" method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <div class="modal-header">
                            <h4 class="modal-title text-center" id="delModalLabel">Conferma Eliminazione</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p>Sei sicuro di voler eliminare questo utente?</p>
                            <p class="danger">Attenzione operazione irreversibile!<br> Una volta confermato non sarà
                                possibile ripristinare i dati.</p>
                            <input type="hidden" name="user_id" id="user_id" value="">
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

        <!-- Modal Edit User -->
        <div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <form action="{{ route('user.update', $user->id)}}" method="post" class="form-group">
                        @method('PATCH')
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Modifica un utente</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    Sono presenti alcuni errori nel formulario
                                </div>
                            @endif
                            <section id="newUserInfo">
                                <h4>Informazioni utente</h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="userName-label">Nome</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome"
                                           aria-label="Name" aria-describedby="userName-label"
                                           name="userEdit_name" value="" id="userEdit_name">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="userEMail-label">E-Mail</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="EMail"
                                           aria-label="EMail" aria-describedby="userEMail-label"
                                           name="userEdit_email" value="" id="userEdit_email">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="userPassword-label">Password</span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password"
                                           aria-label="Password" aria-describedby="userPassword-label"
                                           name="userEdit_password" value="" id="userEdit_password">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="accessGroup-label">Permessi</span>
                                    </div>
                                    <select class="form-control" id="userEdit_group" aria-label="AccessGroup"
                                            aria-describedby="accessGroup-label" name="userEdit_group">
                                        <option value="" selected disabled>Seleziona il permesso
                                        </option>
                                        <option value=1>Lettura</option>
                                        <option value=2>Lettura/Scrittura</option>
                                        <option value=3>Amministratore</option>
                                    </select>
                                </div>
                            </section>
                            <input type="hidden" name="userEdit_id" id="userEdit_id" value="">
                        </div>
                        <div class="modal-footer">
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
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

        <script src="{{URL::asset('js/usersModal.js')}}"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" defer></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js" defer></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
        <script src="{{URL::asset('js/search.js')}}"></script>
    @else
        <h3>Non sei autorizzato ad accedere a questa pagina.</h3>
    @endif
@endsection