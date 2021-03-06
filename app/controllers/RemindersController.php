<?php

class RemindersController extends BaseController {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		$this->layout->nest('content','users.password_remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with(['notif'=>['message'=>Lang::get($response),'type'=>'danger']]);

			case Password::REMINDER_SENT:
				return Redirect::back()->with(['notif'=>['message'=>Lang::get($response).' '.Input::get('email'),'type'=>'success']]);
				
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);
		$this->layout->nest('content','users.password_reset',compact('token'));
		
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
					return Redirect::back()->with(['notif'=>['message'=>Lang::get($response),'type'=>'danger']]);
				

			case Password::PASSWORD_RESET:
				return Redirect::to('/')->with(['notif'=>['message'=>Lang::get($response).' '.Input::get('email'),'type'=>'success']]);
				
		}
	}

}
