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

}
