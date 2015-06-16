<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'survey_questions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'question',
        'survey_id'
    ];


    public function survey() {
        return $this->belongsTo('App\Survey');
    }

    public function answers() {
        return $this->hasMany('App\SurveyAnswer', 'question_id', 'id');
    }

    public function getDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }

}
