<?php

class GenerosController extends BaseController
{
	protected $genero;

	public function __construct(Genero $genero)
	{
		parent::__construct();
		$this->genero = $genero;
	}

	public function index()
	{
		$descricao = null;

		$sort = 'descricao';
		$order = Input::get('order') === 'desc' ? 'desc' : 'asc';

		$generos = $this->genero->orderBy($sort, $order);

		if(Input::has('descricao')) {
			$generos = $generos->where('descricao', 'LIKE', '%' . Input::get('descricao') . '%' );
			$descricao = '&descricao=' . Input::get('descricao');
		}

		$generos = $generos->paginate(7);

		$pagination = $generos->appends(array(
			'descricao' => Input::get('descricao'),
			'sort' => Input::get('sort'),
			'order' => Input::get('order'),
		))->links();

		return View::make('generos.index')
			->with(array(
				'descricao' => Input::get('descricao'),
				'generos' => $generos,
				'pagination' => $pagination,
				'str' => '&order=' . (Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $descricao
			));
	}


	public function create()
	{
		return View::make('generos.create');
	}

	public function store()
	{
		$input = Input::all();
		$validator = Genero::validate($input);

		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG001'));
		} else {
			
			$this->genero->create($input);
			return Redirect::to('genero')
				->with('success', Util::message('MSG002'));
		}
	}

	public function edit($id)
	{
		$genero = $this->genero->find($id);

		if(is_null($genero)) {
			return Redirect::to('genero')
				->with('error', Util::message('MSG003'));
		}

		return View::make('generos.edit')
			->with('genero', $genero);
	}

	public function update($id)
	{
		$input = Input::all();
		$input['id'] = $id;

		$validator = Genero::validate($input);

		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG004'));
		} else {
			
			$this->genero->find($id)->update($input);
			return Redirect::to('genero')
				->with('success', Util::message('MSG005'));
		}
	}

	public function destroy($id)
	{
		try {
			
			$this->genero->find($id)->delete();
			
			return Redirect::to('genero')
				->with('success', Util::message('MSG006'));

		} catch (Exception $e) {
			return Redirect::to('genero')
				->with('warning', Util::message('MSG007'));
		}
	}
}