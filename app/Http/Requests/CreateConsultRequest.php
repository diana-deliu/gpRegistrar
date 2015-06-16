<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateConsultRequest extends Request {

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
            'height' => 'required|max:300|integer',
            'weight' => 'required|max:1000|integer',
            'abdominal_circumference' => 'required|max:1000|integer',
            'blood_pressure' => 'required|max:10|string',
            'glucose' => 'required|max:1000|integer',
        ];
    }

}
