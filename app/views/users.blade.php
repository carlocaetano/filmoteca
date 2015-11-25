@extends('layout')
@section('content')
  Usuarios: <br>
  @foreach($users as $user)
	<p>ID: {{ $user->id }}<br>
	NOME: {{ $user->name }}<br>
	EMAIL: {{ $user->email }}</p>
@endforeach
@stop

