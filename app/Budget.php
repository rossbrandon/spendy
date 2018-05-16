<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
}
