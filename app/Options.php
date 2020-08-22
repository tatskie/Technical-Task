<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option', 'is_correct', 'question_id'
    ];

    /**
     * Relationship to Question
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
