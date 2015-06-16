<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'labs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['patient_id', 'date', 'next_date', 'hemoglobin', 'vsh', 'transaminases', 'cholesterol', 'triglycerides', 'creatinine', 'urea', 'urine', 'copro'];


    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function getDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }

    public function getNextDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }


}
