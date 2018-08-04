@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <ol class="breadcrumb panel-heading">
                    <li class="active">Empréstimos</li>
                </ol>
                <div class="panel-body">
                    <form class="form-inline" action="{{ route('lending.search') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="@TODO Usuário">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                    </form>
                    <br />
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Usuário</th>
                                <th>Livros</th>
                                <th>Data empréstimo</th>
                                <th>Data devolução</th>
                                <th>Data entrega</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lendings as $lending)
                                <tr>
                                    <th scope="row" class="text-center">{{ $lending->id }}</th>
                                    <td>{{ $lending->user->name }} {{ $lending->user->surname }}</td>
                                    <td>
                                        <ul class="list-unstyled">
                                        @foreach($lending->books as $book)
                                            <li>{{ $book->title }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($lending->date_start)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($lending->date_end)) }}</td>
                                    <td>
                                        @if ($lending->date_finish !== null)
                                            {{ date('d/m/Y', strtotime($lending->date_finish)) }}
                                        @else
                                            Não devolvido
                                        @endif
                                    </td>
                                    <td width="155" class="text-center">
                                        @if ($lending->date_finish === null)
                                        <p><a href="{{route('lend.return', $lending->id)}}" class="btn btn-success">Devolver</a></p>
                                        @endif
                                        <a href="{{route('lending.edit', $lending->id)}}" class="btn btn-default">Editar</a>
                                        <a href="{{route('lending.delete', $lending->id)}}" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(!isset($search))
                    <div align="center">
                        {!! $lendings->links() !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection