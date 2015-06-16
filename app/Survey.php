<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'surveys';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
    ];


    public function questions() {
        return $this->hasMany('App\SurveyQuestion');
    }

    public function getStartDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }

    public function getEndDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }

}
