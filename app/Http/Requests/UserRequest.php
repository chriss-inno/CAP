<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
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
            'new_password_repeat' => 'required|min:8',
            'new_password' => 'required|min:8',
            'old_password' => 'required',
        ];
	}

}
