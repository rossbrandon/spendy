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
        'budget_id',
        'place',
        'date',
        'price',
        'reason'
    ];

    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }
}
