@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<ol class="breadcrumb panel-heading">
                	<li><a href="{{route('lending.index')}}">Emprestimos</a></li>
                	<li class="active">Editar</li>
                </ol>
                <div class="panel-body">
	                <form action="{{ route('lending.update', $lending->id) }}" method="POST" enctype="multipart/form-data">
	                	{{ csrf_field() }}
                        <div class="form-group">
                            <label for="user">Usuário</label>
                            <select name="user" class="form-control selectpicker" data-live-search="true" title="Selecione o usuário">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $lending->user->id ? 'selected' : '' }}>{{ $user->name }} {{ $user->surname }}</option>
                                @endforeach()
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Livros</label>
                            <select name="book[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Selecione os livros">
                                @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ in_array($book->id, $selected_books) ? 'selected' : '' }}>{{ $book->title }}</option>
                                @endforeach()
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date_start">Data empréstimo</label>
                            <input type="text" class="form-control" name="date_start" id="date_start" placeholder="Data empréstimo" value="{{ date('d/m/Y', strtotime($lending->date_start)) }}">
                        </div>
                        <div class="form-group">
                            <label for="date_end">Data devolução</label>
                            <input type="text" class="form-control" name="date_end" id="date_start" placeholder="Data devolução" value="{{ date('d/m/Y', strtotime($lending->date_end)) }}">
                        </div>
                        <div class="form-group">
                            <label for="date_finish">Data entrega</label>
                            <input type="text" class="form-control" name="date_finish" id="date_finish" placeholder="Data entrega" value="{{ date('d/m/Y', strtotime($lending->date_finish)) }}">
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
