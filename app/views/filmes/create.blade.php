@extends('layouts.master')

@section('content')
	<div class="form generic">
		<header>
			{{ link_to('filme', 'Voltar', array('class' => 'btn btn_back')) }}
			<h4>Adicionar filme</h4>
		</header>

		{{ Form::open(array('url' => 'filme', 'files' => true)) }}

			{{ Form::label('titulo_original', '*Título original') }}
			{{ Form::text('titulo_original', Input::old('titulo_original')) }}
			{{ $errors->first('titulo_original', '<span class="error">:message</span>') }}
			
			{{ Form::label('titulo_portugues', '*Título em português') }}
			{{ Form::textarea('titulo_portugues', Input::old('titulo_portugues')) }}
			{{ $errors->first('titulo_portugues', '<span class="error">:message</span>') }}

			{{ Form::label('tipo_id', '*Tipo') }}
			{{ Form::select('tipo_id', Tipo::options(), Input::old('tipo_id'), array('class' => 'select')) }}
			{{ $errors->first('tipo_id', '<span class="error">:message</span>') }}

			{{ Form::label('genero_id', '*Gênero') }}
			{{ Form::select('genero_ids[]', Genero::options(), Input::old('genero_id'), array('multiple', 'class' => 'select')) }}
			{{ $errors->first('genero_id', '<span class="error">:message</span>') }}

			{{ Form::label('lancamento', '*Lançamento') }}
			{{ Form::text('lancamento', Input::old('lancamento'), array('class' => 'data')) }}
			{{ $errors->first('lancamento', '<span class="error">:message</span>') }}

			{{ Form::label('poster', '*Poster') }}
			{{ Form::file('poster') }}
			{{ $errors->first('poster', '<span class="error">:message</span>') }}

			{{ Form::label('sinopse', 'Sinopse') }}
			{{ Form::textarea('sinopse', Input::old('sinopse')) }}
			{{ $errors->first('sinopse', '<span class="error">:message</span>') }}	

			{{ Form::label('avaliacao', '*Avaliação') }}
			{{ Form::select('avaliacao', array('' => 'Selecione uma opção', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5), Input::old('avaliacao')) }}
			{{ $errors->first('avaliacao', '<span class="error">:message</span>') }}

			{{ Form::label('imdb', '*IMDB') }}
			{{ Form::text('imdb', Input::old('imdb')) }}
			{{ $errors->first('imdb', '<span class="error">:message</span>') }}

			{{ Form::label('duracao', '*Duração (em minutos)') }}
			{{ Form::text('duracao', Input::old('duracao')) }}
			{{ $errors->first('duracao', '<span class="error">:message</span>') }}

			{{ Form::label('discos', '*Discos') }}
			{{ Form::text('discos', Input::old('discos')) }}
			{{ $errors->first('discos', '<span class="error">:message</span>') }}

			{{ Form::label('ano', '*Ano') }}
			{{ Form::text('ano', Input::old('ano')) }}
			{{ $errors->first('ano', '<span class="error">:message</span>') }}

			{{ Form::label('comentario', 'Comentario') }}
			{{ Form::textarea('comentario', Input::old('comentario')) }}
			{{ $errors->first('comentario', '<span class="error">:message</span>') }}	


			{{ Form::submit('Salvar') }}

		{{ Form::close() }}
	</div>
@stop