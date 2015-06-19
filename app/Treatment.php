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
        'treatment',
        'extra',
        'referral',
    ];


    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function getDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }

}
