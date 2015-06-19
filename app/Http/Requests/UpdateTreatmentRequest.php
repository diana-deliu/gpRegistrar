<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateTreatmentRequest extends Request {

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
            'diagnosis' => 'required|integer',
            'treatment' => 'required|integer',
            'extra' => 'max:65535|string',
            'referral' => 'max:65535|string',
		];
	}

}
