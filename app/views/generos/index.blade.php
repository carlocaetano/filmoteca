@extends('layouts.master')
@section('content')
	<div class="list generic">
		<header>
			{{ link_to('genero/create', 'Novo', array('class' => 'btn btn_new')) }}
			<h4>Gêneros</h4>
		</header>
		{{ Form::open(array('url' => 'genero', 'method' => 'get')) }}
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição')) }}
			{{ Form::button('Pesquisar', array('type' => 'submit', 'class' => 'btn btn_search') ) }}
		{{ Form::close() }}

		@if($generos->getItems())
			<table>
				<thead>
					<tr>
						<th><a href="{{ URL::to('genero?sort=descricao' . $str) }}">Descrição</a></th>
						<th colspan="2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($generos as $genero)
						<tr>
							<td>{{ e($genero->descricao) }} </td>
							<td class="action">
								{{ link_to('genero/' . $genero->id . '/edit', '', array('class' => 'ico ico_edit',
								'title' => 'Editar')) }}
							</td>
							<td class="action">
								{{ Form::open(array('url' => 'genero/' . $genero->id, 'method' => 'delete',
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
					Exibindo de {{ $generos->getFrom() }} até {{ $generos->getTo() }} de {{ $generos->getTotal() }} registros.
				</p>
			</div>
		@else
			<p class="no_information"> {{ Util::message('MSG008') }} </p>
		@endif
	</div>
@stop