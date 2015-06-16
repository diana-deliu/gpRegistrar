<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'practice', 'doc_code', 'address', 'user_id'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getDateAttribute($value) {
        $date = date_create_from_format("Y-m-d H:i:s", $value);
        return date_format($date, 'd.m.Y H:i');
    }

}
