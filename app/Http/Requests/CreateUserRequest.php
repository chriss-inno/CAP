<?php namespace App\Http\Requests;

use App\Http\Requests\Request;


class CreateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
    protected $redirect = 'users/create';

	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_repeat' => 'required|min:8',
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'role' => 'required',
        ];
	}

}
