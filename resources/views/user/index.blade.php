@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <ol class="breadcrumb panel-heading">
                    <li class="active">Usuários</li>
                </ol>
                <div class="panel-body">
                    <form class="form-inline" action="{{ route('user.search') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                    </form>
                    <br />
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Permissão</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row" class="text-center">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ($user->role == 0 ? 'Aluno' : ($user->role == 255 ? 'Administrador' : '')) }}</td>
                                    <td width="155" class="text-center">
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-default">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(!isset($search))
                    <div align="center">
                        {!! $users->links() !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection