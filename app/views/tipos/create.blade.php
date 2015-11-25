@extends('layouts.master')

@section('content')
	<div class="form generic">
		<header>
			{{ link_to('tipo', 'Voltar', array('class' => 'btn btn_back')) }}
			<h4>Adicionar tipo</h4>
		</header>

		{{ Form::open(array('url' => 'tipo')) }}

			{{ Form::label('titulo', '*Título') }}
			{{ Form::text('titulo', Input::old('titulo')) }}
			{{ $errors->first('titulo', '<span class="error">:message</span>') }}
			
			{{ Form::label('descricao', '*Descrição') }}
			{{ Form::textarea('descricao', Input::old('descricao')) }}
			{{ $errors->first('descricao', '<span class="error">:message</span>') }}

			{{ Form::submit('Salvar') }}

		{{ Form::close() }}
	</div>
@stop