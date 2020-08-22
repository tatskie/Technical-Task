<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'points', 'category_id', 'exam_id'
    ];

    /**
     * Relationship to Exam
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Relationship to Question Category
     */
    public function questionCategory()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }

    /**
     * Relationship to Options
     */
    public function options()
    {
        return $this->hasMany(Options::class);
    }
}
