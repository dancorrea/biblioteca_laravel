@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<ol class="breadcrumb panel-heading">
                	<li><a href="{{route('lending.index')}}">Empréstimos</a></li>
                	<li class="active">Adicionar</li>
                </ol>
                <div class="panel-body">
	                <form action="{{ route('lending.save') }}" method="POST" enctype="multipart/form-data">
	                	{{ csrf_field() }}
                        <div class="form-group">
                            <h4><strong><u>Resumo do empréstimo</u></strong></h4>
                        </div> 
                        <div class="form-group">
                            <span><strong>Usuário:</strong> {{ auth()->user()->name }} </span>
                        </div>
                        <div class="form-group">
                            <span><strong>Data empréstimo:</strong> {{ date('d-m-Y', strtotime($date_start)) }} </span>
                        </div>
                        <div class="form-group">
                            <span><strong>Data devolução:</strong> {{ date('d-m-Y', strtotime($date_end)) }} </span>
                        </div>
                        <br>                   
						<div class="form-group">
                            <label for="name">Selecionar livros</label>
                            <select name="book[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Livros">
                                @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach()
                            </select>
                            <p class="help-block">Use Crtl para selecionar.</p>
                        </div>
						<br />
						<button type="submit" class="btn btn-primary">Confirmar</button>
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection