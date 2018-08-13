@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<ol class="breadcrumb panel-heading">
                	<li><a href="{{route('book.index')}}">Livros</a></li>
                	<li class="active">Adicionar</li>
                </ol>
                <div class="panel-body">
	                <form action="{{ route('book.save') }}" method="POST" enctype="multipart/form-data">
	                	{{ csrf_field() }}
						<div class="form-group">
						  	<label for="name">Título</label>
						    <input type="text" class="form-control" name="title" id="title" placeholder="Título">
						</div>
                        <div class="form-group">
                            <label for="name">Autor</label>
                            <select name="autor[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Autores">
                                @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name . " " . $author->surname}}</option>
                                @endforeach()
                            </select>
                            <p class="help-block">Use Crtl para selecionar.</p>
                        </div>
                        <div class="control-group input-images">
                            
                            <br />
                            <div class="controls">
                                <input name="images[]" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control" rows="3" name="description" id="description"></textarea>
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