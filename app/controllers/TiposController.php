<?php

class TiposController extends BaseController
{
	protected $tipo;

	public function __construct(Tipo $tipo)
	{
		parent::__construct();
		$this->tipo = $tipo;
	}

	public function index()
	{
		$titulo = $descricao = null;

		$fields = array('titulo', 'descricao');

		$sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'titulo';
		$order = Input::get('order') === 'desc' ? 'desc' : 'asc';

		$tipos = $this->tipo->orderBy($sort, $order);

		if(Input::has('titulo')) {
			$tipos = $tipos->where('titulo', 'LIKE', '%' . Input::get('titulo') . '%' );
			$titulo = '&titulo=' . Input::get('titulo');
		}

		if(Input::has('descricao')) {
			$tipos = $tipos->where('descricao', 'LIKE', '%' . Input::get('descricao') . '%' );
			$descricao = '&descricao=' . Input::get('descricao');
		}

		$tipos = $tipos->paginate(5);

		$pagination = $tipos->appends(array(
			'descricao' => Input::get('descricao'),
			'titulo' => Input::get('titulo'),
			'sort' => Input::get('sort'),
			'order' => Input::get('order'),
		))->links();

		return View::make('tipos.index')
			->with(array(
				'descricao' => Input::get('descricao'),
				'titulo' => Input::get('titulo'),
				'tipos' => $tipos,
				'pagination' => $pagination,
				'str' => '&order=' . (Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $titulo . $descricao
			));
	}


	public function create()
	{
		return View::make('tipos.create');
	}

	public function store()
	{
		$input = Input::all();
		$validator = Tipo::validate($input);

		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG001'));
		} else {
			
			$this->tipo->create($input);
			return Redirect::to('tipo')
				->with('success', Util::message('MSG002'));
		}
	}

	public function edit($id)
	{
		$tipo = $this->tipo->find($id);

		if(is_null($tipo)) {
			return Redirect::to('tipo')
				->with('error', Util::message('MSG003'));
		}

		return View::make('tipos.edit')
			->with('tipo', $tipo);
	}

	public function update($id)
	{
		$input = Input::all();

		$validator = Tipo::validate($input);

		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG004'));
		} else {
			
			$this->tipo->find($id)->update($input);
			return Redirect::to('tipo')
				->with('success', Util::message('MSG005'));
		}
	}

	public function destroy($id)
	{
		try {
			
			$this->tipo->find($id)->delete();
			
			return Redirect::to('tipo')
				->with('success', Util::message('MSG006'));

		} catch (Exception $e) {
			return Redirect::to('tipo')
				->with('warning', Util::message('MSG007'));
		}
	}
}