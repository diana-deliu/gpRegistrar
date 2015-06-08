<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'treatments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'date',
        'diagnosis',
        'interval',
        'treatment',
        'extra',
        'referral',
        'appointment'
    ];


    public function patient() {
        return $this->belongsTo('App\Patient');
    }

}
