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
    protected $fillable = ['cnp','firstname', 'lastname', 'address', 'user_id'];


    public function user() {
        return $this->belongsTo('App\User');
    }

}
