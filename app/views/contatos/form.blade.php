@extends('layouts.master')

@section('content')
	<div class="form generic">
		<header>
			<h4>Enviar contato</h4>
		</header>

		{{ Form::open(array('action' => 'ContatosController@send')) }}
			
			{{ Form::label('nome', '*Nome:') }}
			{{ Form::text('nome', Input::old('nome')) }}
			{{ $errors->first('nome', '<span class="error">:message</span>') }}

			{{ Form::label('email', '*Email:') }}
			{{ Form::text('email', Input::old('email')) }}
			{{ $errors->first('email', '<span class="error">:message</span>') }}

			{{ Form::label('telefone', '*Telefone:') }}
			{{ Form::text('telefone', Input::old('telefone')) }}
			{{ $errors->first('telefone', '<span class="error">:message</span>') }}

			{{ Form::label('assunto', '*Assunto:') }}
			{{ Form::textarea('assunto', Input::old('assunto')) }}
			{{ $errors->first('assunto', '<span class="error">:message</span>') }}

			{{ Form::submit('Enviar') }}

		{{ Form::close() }}
	</div>
@stop