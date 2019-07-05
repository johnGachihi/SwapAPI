<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferedGoods extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    public function offer() {
        return $this->belongsTo('App\Offer');
    }
}
