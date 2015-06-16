<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateVaccineRequest extends Request {

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
            'patient_id' => 'required|integer|min:0',
            'date' => 'required|date',
            'next_date' => 'required|date',
            'category' => 'required|integer',
            'vsh' => 'max:1000|integer',
            'notification' => 'in:on,',
            'appointment' => 'in:on,'
		];
	}

}
