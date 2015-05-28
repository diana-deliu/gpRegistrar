<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMedicRequest extends Request {

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
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'practice' => 'required|max:255',
            'doc_code' => 'required|max:8',
            'address' => 'required|max:65535',
        ];
	}

}
