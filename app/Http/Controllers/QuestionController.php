<?php

namespace App\Http\Controllers;

use App\Options;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
          'question' => 'required|max:255',
          'points' => 'required|integer',
          'category_id' => 'required|integer',
          'exam_id' => 'required|integer',
        ]);

        $question = Question::create($data);

        Options::create([
            'option' => 'Number one',
            'is_correct' => true,
            'question_id' => $question->id
        ]);

        Options::create([
            'option' => 'Number two',
            'question_id' => $question->id
        ]);

        Options::create([
            'option' => 'Number three',
            'question_id' => $question->id
        ]);

        Options::create([
            'option' => 'Number four',
            'question_id' => $question->id
        ]);

        return response()->json($question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function questionOptions($id)
    {
        $question = Question::find($id);

        return response()->json($question->options);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);

        return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
          'question' => 'required|max:255',
          'points' => 'required|integer',
          'category_id' => 'required|integer',
        ]);

        $question = Question::find($id);

        $question->question = $request->get('question');
        $question->points = $request->get('points');
        $question->category_id = $request->get('category_id');

        $question->save();

        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id)->delete();

        return response()->json(['success'=>'Question Deleted successfully']);
    }
}
