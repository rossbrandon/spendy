<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
}
