<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateLabRequest extends Request {

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
            'hemoglobin' => 'max:1000|integer',
            'vsh' => 'max:1000|integer',
            'transaminases' => 'max:1000|integer',
            'cholesterol' => 'max:1000|integer',
            'triglycerides' => 'max:1000|integer',
            'creatinine' => 'max:1000|integer',
            'urea' => 'max:1000|integer',
            'urine' => 'max:1000|integer',
            'copro' => 'max:1000|integer',
        ];
    }

}
