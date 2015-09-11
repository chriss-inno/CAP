<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportGenerateRequest extends Request {

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
			//
            'search_text'=>'alpha_dash',
            'date_from'=>'date',
            'date_to'=>'date'
		];
	}

}
