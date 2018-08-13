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

                    <form class="form-inline" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group" style="float: right;">
                            <p><a href="{{route('lending.add')}}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i> Adicionar</a></p>
                        </div>
                    </form>

                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Usuário</th>
                                <th>Livros</th>
                                <th>Data de Empréstimo</th>
                                <th>Data de Devolução</th>
                                <th>Ações</th>                                
                            </tr>
                        </thead>
                        @if($user->role == 1)
                        <tbody>
                            @foreach($lendings as $lending)
                                <tr>
                                    <th scope="row" class="text-center">{{ $lending->id }}</th>   
                                    <td>
                                        {{ $lending->user->name }}
                                    </td>
                                    <td>
                                        @foreach($lending->books as $book)
                                            <div>{{ $book->title }}</div>
                                        @endforeach()
                                    </td>
                                    <td>{{ date_format($lending->date_start,"d/m/Y") }}</td>
                                    <td>{{ date_format($lending->date_end,"d/m/Y") }}</td>
                                    @if($lending->date_finish)
                                        <td>Devolvido em: {{ date_format($lending->date_finish,"d/m/Y") }}</td>
                                        @else
                                        <td width="155" class="text-center">
                                            <a href="{{route('lending.edit', $lending->id)}}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="{{route('lending.delete', $lending->id)}}" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-save"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        @else($user->role == 0)
                        <tbody>
                            @foreach($lendings as $lending)
                                <tr>
                                    <th scope="row" class="text-center">{{ $lending->id }}</th>   
                                    <td>
                                        {{ $user->name }} <!-- ajustar -->
                                    </td>
                                    <td>
                                        @foreach($lending->books as $book)
                                            <div>{{ $book->title }}</div>
                                        @endforeach()
                                    </td>
                                    <td>{{ date_format($lending->date_start,"d/m/Y") }}</td>
                                    <td>{{ date_format($lending->date_end,"d/m/Y") }}</td>
                                    @if($lending->date_finish)
                                        <td>Devolvido em: {{ date_format($lending->date_finish,"d/m/Y") }}</td>
                                        @else
                                        <td width="155" class="text-center">
                                            <a href="{{route('lending.edit', $lending->id)}}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="{{route('lending.delete', $lending->id)}}" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-save"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection