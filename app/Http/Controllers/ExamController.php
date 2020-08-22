<?php

namespace App\Http\Controllers;

use App\Exam;
use App\QuestionCategory;
use Illuminate\Http\Request;

class ExamController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam = Exam::all();

        return view('exam.index', compact('exam'));
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
          'title'       => 'required|max:255',
        ]);

        $exam = Exam::create($data);
        
        return response()->json($exam);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);

        return response()->json($exam);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::find($id);

        $categories = QuestionCategory::all();

        return view('exam.view', compact(['exam', 'categories']));
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
          'title'       => 'required|max:255',
        ]);

        $exam = Exam::find($id);

        $exam->title = $request->get('title');

        $exam->save();

        return response()->json($exam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $exam = Exam::find($id)->delete();

        return response()->json(['success'=>'Exam Deleted successfully']);
    }
}
