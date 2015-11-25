<?php

class FilmesController extends BaseController
{
	protected $filme;

	public function __construct(Filme $filme)
	{
		parent::__construct();
		$this->filme = $filme;
		$this->path = public_path() . '/assets/upload/';
	}

	public function index()
	{
		$titulo_portugues = $sinopse = $avaliacao = $ano = null;

		$fields = array('titulo_portugues', 'lancamento', 'sinopse', 'avaliacao', 'ano');

		$sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'titulo_portugues';
		$order = Input::get('order') === 'desc' ? 'desc' : 'asc';

		$filmes = $this->filme->orderBy($sort, $order);

		if(Input::has('titulo_portugues')) {
			$filmes = $filmes->where('titulo_portugues', 'LIKE', '%' . Input::get('titulo_portugues') . '%' );
			$titulo_portugues = '&titulo_portugues=' . Input::get('titulo_portugues');
		}

		if(Input::has('sinopse')) {
			$filmes = $filmes->where('sinopse', 'LIKE', '%' . Input::get('sinopse') . '%' );
			$sinopse = '&sinopse=' . Input::get('sinopse');
		}

		if(Input::has('avaliacao') && is_numeric(Input::get('avaliacao'))) {
			$filmes = $filmes->where('avaliacao', '=', Input::get('avaliacao') );
			$avaliacao = '&avaliacao=' . Input::get('avaliacao');
		}

		if(Input::has('ano') && is_numeric(Input::get('ano'))) {
			$filmes = $filmes->where('ano', '=', Input::get('ano') );
			$ano = '&ano=' . Input::get('ano');
		}

		$filmes = $filmes->paginate(5);

		$pagination = $filmes->appends(array(
			'titulo_portugues' => Input::get('titulo_portugues'),
			'sinopse' => Input::get('sinopse'),
			'avaliacao' => Input::get('avaliacao'),
			'ano' => Input::get('ano'),
			'sort' => Input::get('sort'),
			'order' => Input::get('order'),
		))->links();

		return View::make('filmes.index')
			->with(array(
				'titulo_portugues' => Input::get('titulo_portugues'),
				'sinopse' => Input::get('sinopse'),
				'avaliacao' => Input::get('avaliacao'),
				'ano' => Input::get('ano'),
				'filmes' => $filmes,
				'pagination' => $pagination,
				'str' => '&order=' . (Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $titulo_portugues . $sinopse 	. $avaliacao . $ano
			));
	}


	public function create()
	{
		return View::make('filmes.create');
	}

	public function store()
	{
		$input = Input::all();
		$validator = Filme::validate($input);

		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG001'));
		} else {
			$poster = Input::file('poster');

			$file_poster = Str::random(20) . '.' . File::extension($poster->getClientOriginalName());
			$up_poster = $poster->move($this->path, $file_poster);

			Image::make($this->path . $file_poster)->resize(338,500)->save($this->path . $file_poster);

			if($up_poster) {
				$filme = $this->filme->create(array(
					'titulo_original' => Input::get('titulo_original'),
					'titulo_portugues' => Input::get('titulo_portugues'),
					'tipo_id' => Input::get('tipo_id'),
					'lancamento' => Util::toMySQL(Input::get('lancamento')),
					'poster' => $file_poster,
					'sinopse' => Input::get('sinopse'),
					'avaliacao' => Input::get('avaliacao'),
					'imdb' => Input::get('imdb'),
					'ano' => Input::get('ano'),
					'duracao' => Input::get('duracao'),
					'discos' => Input::get('discos'),
					'comentario' => Input::get('comentario'),
				));
				$filme->generos()->sync(Input::get('genero_ids'));

				return Redirect::to('filme')
					->with('success', Util::message('MSG002'));

			} else {

				return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG009'));

			}
		}
	}


	public function show($id)
	{
		$filme = $this->filme->find($id);

		if(is_null($filme)) {
			return Redirect::to('filme')
				->with('error', Util::message('MSG003'));
		}

		return View::make('filmes.show')
			->with('filme', $filme);
	}

	public function edit($id)
	{
		$generos_ids = array();

		$filme = $this->filme->find($id);

		if(is_null($filme)) {
			return Redirect::to('filme')
				->with('error', Util::message('MSG003'));
		}

		if($filme->generos) {
			foreach ($filme->generos as $genero) {
				$generos_ids[] = $genero->id;
			}
		}

		return View::make('filmes.edit')
			->with(array(
					'filme' => $filme,
					'generos_ids' => $generos_ids,
			));
	}

	public function update($id)
	{
		$input = Input::all();

		$validator = Filme::validate($input);

		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG004'));
		} else {
			
			$inputs = array(
				'titulo_original' => Input::get('titulo_original'),
				'titulo_portugues' => Input::get('titulo_portugues'),
				'tipo_id' => Input::get('tipo_id'),
				'lancamento' => Util::toMySQL(Input::get('lancamento')),
				'sinopse' => Input::get('sinopse'),
				'avaliacao' => Input::get('avaliacao'),
				'imdb' => Input::get('imdb'),
				'ano' => Input::get('ano'),
				'duracao' => Input::get('duracao'),
				'discos' => Input::get('discos'),
				'comentario' => Input::get('comentario'),
			);

			if(Input::hasFile('poster')) {
				$poster = Input::file('poster');

				$file_poster = Str::random(20) . '.' . File::extension($poster->getClientOriginalName());
				$up_poster = $poster->move($this->path, $file_poster);
				File::delete($this->path , Input::get('poster_atual'));

				Image::make($this->path . $file_poster)->resize(338,500)->save($this->path . $file_poster);

				$inputs = $inputs + array('poster' => $file_poster);
			}

			$this->filme->find($id)->update($inputs);
			$this->filme->find($id)->generos()->sync(Input::get('genero_ids'));
			
			return Redirect::to('filme')
				->with('success', Util::message('MSG005'));
		}
	}

	public function destroy($id)
	{
		try {
			
			$filme = $this->filme->find($id);

			if (file_exists($this->path . $filme->poster)) {
				File::delete($this->path . $filme->poster);
			}

			foreach ($filme->generos as $genero) {
				$generos_ids[] = $genero->id;
			}

			$filme->generos()->detach($generos_ids);
			$filme->delete();

			return Redirect::to('filme')
				->with('success', Util::message('MSG006'));

		} catch (Exception $e) {
			return Redirect::to('filme')
				->with('warning', Util::message('MSG007'));
		}
	}
}