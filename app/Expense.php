<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'budget_id', 'place', 'date', 'price', 'reason'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }
}
