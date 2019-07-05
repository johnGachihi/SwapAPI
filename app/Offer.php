<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

    public function offered_goods() {
        return $this->hasMany('App\OfferedGood');
    }

    public function good() {
        return $this->belongsTo('App\Good', 'good_offered_for');
    }

}
