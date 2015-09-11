<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Audit extends Model {

	//
 protected $table ="audits";

    //Define relaionships

    public function user()
    {
        return $this->hasMany("User","user_id","id");
    }

}
