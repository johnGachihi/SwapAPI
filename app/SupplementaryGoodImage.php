<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 09/06/2019
 * Time: 17:16
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class SupplementaryGoodImage extends Model
{

    public function good() {
        return $this->belongsTo('App\Good');
    }

}