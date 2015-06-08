<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vaccines';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['patient_id', 'start_date','category', 'interval', 'notification', 'appointment'];


    public function patient() {
        return $this->belongsTo('App\Patient');
    }
}
