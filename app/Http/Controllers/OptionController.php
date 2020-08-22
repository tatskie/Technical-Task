<?php

namespace App\Http\Controllers;

use App\Options;
use App\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = Options::find($id);

        return response()->json($option);
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
          'option' => 'required|max:255',
        ]);
        
        $option = Options::find($id);

        // $question = Question::find($id);

        $option->option = $request->get('option');
        $option->is_correct = $request->get('is_correct');

        $option->save();

        return response()->json($option);
    }
}
