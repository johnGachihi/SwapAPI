<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function User()
    {
        return $this->belongsTo("App\User");
    }


}
