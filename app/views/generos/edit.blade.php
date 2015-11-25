@extends('layouts.master')

@section('content')
	<div class="form generic">
		<header>
			{{ link_to('genero', 'Voltar', array('class' => 'btn btn_back')) }}
			<h4>Alterar gênero</h4>
		</header>

		{{ Form::open(array('url' => 'genero/' . $genero->id, 'method' => 'put')) }}
			
			{{ Form::label('descricao', '*Descrição') }}
			{{ Form::text('descricao', Input::old('descricao', $genero->descricao)) }}
			{{ $errors->first('descricao', '<span class="error">:message</span>') }}

			{{ Form::submit('Alterar') }}

		{{ Form::close() }}
	</div>
@stop