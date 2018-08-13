@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <ol class="breadcrumb panel-heading">
                    <li class="active">Livros</li>
                </ol>
                <div class="panel-body">
                    <form class="form-inline" action="{{ route('book.search') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        @if($role == 1)
                        <div class="form-group" style="float: right;">
                            <p><a href="{{route('book.add')}}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i> Adicionar</a></p>
                        </div>
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Livro">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                    </form>
                    <br />
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Imagem</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Descrição</th>
                                @if($role == 1)
                                    <th>Ações</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <th scope="row" class="text-center">{{ $book->id }}</th>
                                    <td class="center">
                                        <img src="http://127.0.0.1/curso/biblioteca/public/images/{{ $book->image }}"  width="100px" />
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>                                        
                                        @foreach($book->authors as $author)
                                            <div> {{ $author->name . " " . $author->surname }} </div>
                                        @endforeach()                                   
                                    </td>
                                    <td class="text-justify">{{ $book->description }}</td>
                                    @if($role == 1)
                                        <td width="155" class="text-center">
                                            <a href="{{route('book.edit', $book->id)}}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="{{route('book.delete', $book->id)}}" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection