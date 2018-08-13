@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<ol class="breadcrumb panel-heading">
                	<li><a href="{{route('lending.index')}}">Empréstimos</a></li>
                	<li class="active">Editar</li>
                </ol>
                <div class="panel-body">
	                <form action="{{ route('lending.update', $lending->id) }}" method="POST" enctype="multipart/form-data">
	                	{{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Livros</label>
                            <select name="book[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Livros">
                                <?php foreach($books as $book){ ?>
                                    <option value="<?= $book->id ?>" <?= in_array($book->id, $selected_book) ? "selected" : NULL ; ?>><?= $book->title ?></option>
                                <?php } ?>
                            </select>
                            <p class="help-block">Use Crtl para selecionar.</p>
                        </div>                        
                        <div class="form-group">
                            <label for="description">Data de Devolução</label>
                            <input type="date" class="form-control" name="date_end" id="date_end" value="{{ $lending->date_end }}">
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