<?php

class ContatosController extends BaseController {
	public function form() {
		return View::make('contatos.form');
	}


	public function send()
	{
		$input = Input::all();
		Mail::send('emails.contatos.index', $input, function($message) {
			$message->to('carlocaetano@vah.com.br')->replyTo(Input::get('email'))->subject('Contato do Site');
		});
		return Redirect::to('form');
	}
}