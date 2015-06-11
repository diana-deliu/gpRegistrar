<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cnp','firstname', 'lastname', 'address', 'user_id', 'medic_id'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function consults() {
        return $this->hasMany('App\Consult');
    }

    public function labs() {
        return $this->hasMany('App\Lab');
    }

    public function vaccines() {
        return $this->hasMany('App\Vaccine');
    }

    public function treatments() {
        return $this->hasMany('App\Treatment');
    }

    public function surveyAnswers() {
        return $this->hasMany('App\SurveyAnswer');
    }

    public function medic() {
        return $this->belongsTo('App\Medic');
    }

}
