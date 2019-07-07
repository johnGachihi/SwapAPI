<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function User(){
        return $this->belongsTo("App\User");
    }

    public function supplementaryGoodImages() {
        return $this->hasMany('App\SupplementaryGoodImage');
    }

    public function offers() {
        return $this->hasMany('App\Offer', 'good_offered_for');
    }

}
