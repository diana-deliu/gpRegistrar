<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'survey_answers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'question_id',
        'answer',
        'answer_date'
    ];


    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function question() {
        return $this->belongsTo('App\SurveyQuestion');
    }

}
