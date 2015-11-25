@extends('layouts.master')

@section('content')
	<div class="form generic">
		<header>
			{{ link_to('genero', 'Voltar', array('class' => 'btn btn_back')) }}
			<h4>Adicionar gênero</h4>
		</header>

		{{ Form::open(array('url' => 'genero')) }}
			
			{{ Form::label('descricao', '*Descrição') }}
			{{ Form::text('descricao', Input::old('descricao')) }}
			{{ $errors->first('descricao', '<span class="error">:message</span>') }}

			{{ Form::submit('Salvar') }}

		{{ Form::close() }}
	</div>
@stop