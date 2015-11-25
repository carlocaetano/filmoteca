@extends('layouts.master')
@section('content')
	<div class="list generic">
		<header>
			{{ link_to('filme/create', 'Novo', array('class' => 'btn btn_new')) }}
			<h4>Tipos</h4>
		</header>
		{{ Form::open(array('url' => 'filme', 'method' => 'get')) }}
			{{ Form::text('titulo_portugues', $titulo_portugues, array('placeholder' =>'Título Português')) }}
			{{ Form::text('sinopse', $sinopse, array('placeholder' => 'Sinopse')) }}
			{{ Form::select('avaliacao', array('' => 'Avaliação', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5), $avaliacao) }}
			{{ Form::text('ano', $ano, array('placeholder' => 'Ano', 'class' => 'ano')) }}
			{{ Form::button('Pesquisar', array('type' => 'submit', 'class' => 'btn btn_search') ) }}
		{{ Form::close() }}

		@if($filmes->getItems())
			<table>
				<thead>
					<tr>
						<th><a href="{{ URL::to('filme?sort=titulo_portugues' . $str) }}">Título Português</a></th>
						<th><a href="{{ URL::to('filme?sort=lancamento' . $str) }}">Lançamento</a></th>
						<th><a href="{{ URL::to('filme?sort=sinopse' . $str) }}">Sinopse</a></th>
						<th><a href="{{ URL::to('filme?sort=avaliacao' . $str) }}">Avaliação</a></th>
						<th><a href="{{ URL::to('filme?sort=ano' . $str) }}">Ano</a></th>
						<th colspan="3"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($filmes as $filme)
						<tr>
							<td>{{ e($filme->titulo_portugues) }} </td>
							<td>{{ Util::toView($filme->lancamento) }} </td>
							<td>{{ e(Util::truncate($filme->sinopse)) }} </td>
							<td>{{ $filme->avaliacao }} </td>
							<td>{{ $filme->ano }} </td>
							<td class="action">
								{{ link_to('filme/' . $filme->id . '', '', array('class' => 'ico ico_show',
								'title' => 'Detalhar')) }}
							</td>
							<td class="action">
								{{ link_to('filme/' . $filme->id . '/edit', '', array('class' => 'ico ico_edit',
								'title' => 'Editar')) }}
							</td>
							<td class="action">
								{{ Form::open(array('url' => 'filme/' . $filme->id, 'method' => 'delete',
								'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
									{{ Form::button('', array('type' => 'submit', 'class' => 'ico ico_delete', 'title' =>
									'Apagar')) }}	
								{{ Form::close() }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div id="data_paginate">
				{{ $pagination }}
				<p>
					Exibindo de {{ $filmes->getFrom() }} até {{ $filmes->getTo() }} de {{ $filmes->getTotal() }} registros.
				</p>
			</div>
		@else
			<p class="no_information"> {{ Util::message('MSG008') }} </p>
		@endif
	</div>
@stop