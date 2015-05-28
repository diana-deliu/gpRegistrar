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
}
