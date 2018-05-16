<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'amount', 'date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
}
