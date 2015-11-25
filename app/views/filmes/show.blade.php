@extends('layouts.master')
@section('content')
	<div class="show generic">
		<header>
			{{ link_to('filme', 'Voltar', array('class' => 'btn btn_back')) }}
			<h4>Filme :: {{ e($filme->titulo_portugues) }}</h4>
		</header>
		<section>
			<img src="{{ asset('assets/upload/' . $filme->poster) }}" alt="{{ $filme->titulo_original }}" title="{{ $filme->titulo_original }}" />
			<p><b>Título original:</b> {{ e($filme->titulo_original) }}</p>
			<p><b>Título em português:</b> {{ e($filme->titulo_portugues) }}</p>
			<p><b>Tipo:</b> {{ e($filme->tipo->titulo) }} - {{ e($filme->tipo->descricao) }} </p>
			<p>
				<b>Gênero</b>:
				@foreach ($filme->generos as $genero)
					{{ $genero->descricao }},
				@endforeach
			</p>
			<p><b>Lançamento:</b> {{ Util::toView($filme->lancamento) }}</p>
			<p><b>Sinopse:</b> {{ e($filme->sinopse) }}</p>
			<p><b>Avaliação:</b> {{ e($filme->avaliacao) }}</p>
			<p><b>IMDB:</b> {{ e($filme->imdb) }}</p>
			<p><b>Duração (em minutos):</b> {{ e($filme->duracao) }}</p>
			<p><b>Discos:</b> {{ e($filme->discos) }}</p>
			<p><b>Ano:</b> {{ e($filme->ano) }}</p>
			<p><b>Comentário:</b> {{ e($filme->comentario) }}</p>
		</section>
	</div>
@stop