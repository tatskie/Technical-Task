<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category'
    ];

    /**
     * Relationship to Question
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'cateogry_id');
    }

}
