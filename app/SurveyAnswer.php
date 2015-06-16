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
        return $this->belongsTo('App\SurveyQuestion', 'id', 'question_id');
    }

    public function getDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }

}
