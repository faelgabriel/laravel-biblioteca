@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <ol class="breadcrumb panel-heading">
                    <li class="active">Emprestar</li>
                </ol>
                <div class="panel-body">
                    <form action="{{ route('lend.save') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Usuário</label>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="form-group">
                            <label for="book">Livros</label>
                            <select name="book[]" class="selectpicker" multiple="" data-live-search="true" title="Selecione os livros">
                                @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach()
                            </select>
                            <p class="help-block">Use Crtl para selecionar.</p>
                        </div>
                        <div class="form-group">
                            <label for="title">Data locação</label>
                            <span>{{ date('d/m/Y') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title">Data devolução</label>
                            <span>{{ date('d/m/Y', strtotime("+7 days")) }}</span>
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
