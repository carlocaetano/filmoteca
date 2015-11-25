@extends('layouts.master')

@section('content')
	<div class="form generic">
		<header>
			{{ link_to('filme', 'Voltar', array('class' => 'btn btn_back')) }}
			<h4>Alterar filme</h4>
		</header>

		{{ Form::open(array('url' => 'filme/' . $filme->id, 'method' => 'put', 'files' => true)) }}

			{{ Form::label('titulo_original', '*Título original') }}
			{{ Form::text('titulo_original', Input::old('titulo_original', $filme->titulo_original)) }}
			{{ $errors->first('titulo_original', '<span class="error">:message</span>') }}
			
			{{ Form::label('titulo_portugues', '*Título em português') }}
			{{ Form::textarea('titulo_portugues', Input::old('titulo_portugues', $filme->titulo_portugues)) }}
			{{ $errors->first('titulo_portugues', '<span class="error">:message</span>') }}

			{{ Form::label('tipo_id', '*Tipo') }}
			{{ Form::select('tipo_id', Tipo::options(), Input::old('tipo_id', $filme->tipo_id), array('class' => 'select')) }}
			{{ $errors->first('tipo_id', '<span class="error">:message</span>') }}

			{{ Form::label('genero_id', '*Gênero') }}
			{{ Form::select('genero_ids[]', Genero::options(), Input::old('genero_id', $generos_ids), array('multiple', 'class' => 'select')) }}
			{{ $errors->first('genero_id', '<span class="error">:message</span>') }}

			{{ Form::label('lancamento', '*Lançamento') }}
			{{ Form::text('lancamento', Input::old('lancamento', Util::toView($filme->lancamento)), array('class' => 'data')) }}
			{{ $errors->first('lancamento', '<span class="error">:message</span>') }}

			{{ Form::label('poster', '*Poster') }}
			{{ Form::file('poster') }}
			{{ $errors->first('poster', '<span class="error">:message</span>') }}

			{{ Form::label('sinopse', 'Sinopse') }}
			{{ Form::textarea('sinopse', Input::old('sinopse', $filme->sinopse)) }}
			{{ $errors->first('sinopse', '<span class="error">:message</span>') }}	

			{{ Form::label('avaliacao', '*Avaliação') }}
			{{ Form::select('avaliacao', array('' => 'Selecione uma opção', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5), 
				Input::old('avaliacao', $filme->avaliacao)) }}
			{{ $errors->first('avaliacao', '<span class="error">:message</span>') }}

			{{ Form::label('imdb', '*IMDB') }}
			{{ Form::text('imdb', Input::old('imdb', $filme->imdb)) }}
			{{ $errors->first('imdb', '<span class="error">:message</span>') }}

			{{ Form::label('duracao', '*Duração (em minutos)') }}
			{{ Form::text('duracao', Input::old('duracao', $filme->duracao)) }}
			{{ $errors->first('duracao', '<span class="error">:message</span>') }}

			{{ Form::label('discos', '*Discos') }}
			{{ Form::text('discos', Input::old('discos', $filme->discos)) }}
			{{ $errors->first('discos', '<span class="error">:message</span>') }}

			{{ Form::label('ano', '*Ano') }}
			{{ Form::text('ano', Input::old('ano', $filme->ano)) }}
			{{ $errors->first('ano', '<span class="error">:message</span>') }}

			{{ Form::label('comentario', 'Comentario') }}
			{{ Form::textarea('comentario', Input::old('comentario', $filme->comentario)) }}
			{{ $errors->first('comentario', '<span class="error">:message</span>') }}	

			{{ Form::hidden('poster_atual', $filme->poster ) }}

			{{ Form::submit('Alterar') }}

		{{ Form::close() }}
	</div>
@stop