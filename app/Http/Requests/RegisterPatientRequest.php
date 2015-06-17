<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterPatientRequest extends Request {

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
			'cnp' => 'required|size:13|string',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ];
	}

}
