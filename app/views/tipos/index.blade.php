@extends('layouts.master')
@section('content')
	<div class="list generic">
		<header>
			{{ link_to('tipo/create', 'Novo', array('class' => 'btn btn_new')) }}
			<h4>Tipos</h4>
		</header>
		{{ Form::open(array('url' => 'tipo', 'method' => 'get')) }}
			{{ Form::text('titulo', $titulo, array('placeholder' => 'Título')) }}
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição')) }}
			{{ Form::button('Pesquisar', array('type' => 'submit', 'class' => 'btn btn_search') ) }}
		{{ Form::close() }}

		@if($tipos->getItems())
			<table>
				<thead>
					<tr>
						<th><a href="{{ URL::to('tipo?sort=titulo' . $str) }}">´Título</a></th>
						<th><a href="{{ URL::to('tipo?sort=descricao' . $str) }}">Descrição</a></th>
						<th colspan="2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tipos as $tipo)
						<tr>
							<td>{{ e($tipo->titulo) }} </td>
							<td>{{ e($tipo->descricao) }} </td>
							<td class="action">
								{{ link_to('tipo/' . $tipo->id . '/edit', '', array('class' => 'ico ico_edit',
								'title' => 'Editar')) }}
							</td>
							<td class="action">
								{{ Form::open(array('url' => 'tipo/' . $tipo->id, 'method' => 'delete',
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
					Exibindo de {{ $tipos->getFrom() }} até {{ $tipos->getTo() }} de {{ $tipos->getTotal() }} registros.
				</p>
			</div>
		@else
			<p class="no_information"> {{ Util::message('MSG008') }} </p>
		@endif
	</div>
@stop