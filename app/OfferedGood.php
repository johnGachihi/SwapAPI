<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferedGood extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

    public function offer() {
        return $this->belongsTo('App\Offer');
    }

    public function good() {
        return $this->belongsTo('App\Good');
    }
}
