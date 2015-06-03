<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model {

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
    protected $fillable = ['patient_id', 'height', 'weight', 'abdominal_circumference', 'blood_pressure', 'glucose'];


    public function patient() {
        return $this->belongsTo('App\Patient');
    }

}
