@extends('layouts.master')

@section('content')
	<div class="form generic">
		<header>
			{{ link_to('tipo', 'Voltar', array('class' => 'btn btn_back')) }}
			<h4>Alterar tipo</h4>
		</header>

		{{ Form::open(array('url' => 'tipo/' . $tipo->id, 'method' => 'put')) }}

			{{ Form::label('titulo', '*Título') }}
			{{ Form::text('titulo', Input::old('titulo', $tipo->titulo)) }}
			{{ $errors->first('titulo', '<span class="error">:message</span>') }}
			
			{{ Form::label('descricao', '*Descrição') }}
			{{ Form::textarea('descricao', Input::old('descricao', $tipo->descricao)) }}
			{{ $errors->first('descricao', '<span class="error">:message</span>') }}

			{{ Form::submit('Alterar') }}

		{{ Form::close() }}
	</div>
@stop