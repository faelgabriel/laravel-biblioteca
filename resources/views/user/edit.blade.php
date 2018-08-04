@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<ol class="breadcrumb panel-heading">
                	<li><a href="{{route('user.index')}}">Usuários</a></li>
                	<li class="active">Editar</li>
                </ol>
                <div class="panel-body">
	                <form action="{{ route('user.update', $user->id) }}" method="POST">
	                	{{ csrf_field() }}
                        <div class="form-group">
                            <label>Nome</label>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="form-group">
                            <label for="role">Permissão</label>
                            <select name="role" id="role">
                                <option value="0" {{ $user->role == 0 ? 'selected':'' }}>Aluno</option>
                                <option value="255" {{ $user->role == 255 ? 'selected':'' }}>Administrador</option>
                            </select> 
                        </div>
						<br />
						<button type="submit" class="btn btn-primary">Salvar</button>
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
