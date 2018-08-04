@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<ol class="breadcrumb panel-heading">
                	<li><a href="{{route('book.index')}}">Livros</a></li>
                	<li class="active">Editar</li>
                </ol>
                <div class="panel-body">
	                <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
	                	{{ csrf_field() }}
						<div class="form-group">
						  	<label for="title">Título</label>
						    <input type="text" class="form-control" name="title" id="title" placeholder="Título" value="{{ $book->title }}">
						</div>
                        <div class="form-group">
                            <img src="/images/book/{{ $book->image }}"  width="10%" />
                            <input type="hidden" name="deleteimage" value="{{ $book->image }}">
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input name="image" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="author">Autores</label>
                            <select name="author[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Autores">
                                @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ in_array($author->id, $selected_authors) ? 'selected' : '' }}>{{ $author->name }} {{ $author->surname }}</option>
                                @endforeach()
                            </select>
                            <p class="help-block">Use Crtl para selecionar.</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="Descrição" value="{{ $book->description }}">
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
