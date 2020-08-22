@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $exam->title }}
                    <button type="button" class="btn btn-outline-primary float-right" id="btn-add-question">Add Question</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Question</th>
                          <th scope="col">Points</th>
                          <th scope="col">Categories</th>
                          <th scope="col">Options</th>
                          <th scope="col">Operation</th>
                        </tr>
                      </thead>
                      <tbody id="question-lists" name="question-lists">
                          @foreach ($exam->questions as $data)
                            <tr id="question{{$data->id}}">
                                <td scope="row">{{$data->id}}</td>
                                <td>{{$data->question}}</td>
                                <td>{{$data->points}}</td>
                                <td>{{$data->questionCategory->category}}</td>
                                <td><button type="button" class="btn btn-outline-success btn-sm" id="choicesView" data-id="{{$data->id}}">View Options</button></td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm" id="questionView" data-id="{{$data->id}}">view</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="questionEdit" data-id="{{$data->id}}">Edit</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" id="questionDelete" data-id="{{$data->id}}">Delete</button>
                                </td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="QuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="new-question">Add New Question</h5>
            <h5 class="modal-title" id="update-question">Update Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="questionForm" name="questionForm" class="form-horizontal" novalidate="">
                <input type="hidden" id="exam_id" name="exam_id" value="{{$exam->id}}">
                <div class="form-group">
                    <label>Question</label>
                    <input type="text" class="form-control" id="question" name="question"
                            placeholder="Enter question" value="">
                    <span class="invalid-feedback" role="alert" id="question-error">
                        <strong id="question-error-message"></strong>
                    </span>
                </div>

                <div class="form-group">
                    <label>Points</label>
                    <input type="number" class="form-control" id="points" name="points"
                            placeholder="Enter points" value="">
                    <span class="invalid-feedback" role="alert" id="points-error">
                        <strong id="points-error-message"></strong>
                    </span>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                      @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert" id="category-error">
                        <strong id="category-error-message"></strong>
                    </span>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="question_id" name="question_id" value="0">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn-save-question" value="add">Save</button>
            <button type="button" class="btn btn-primary" id="btn-update-question" value="update">Update</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Question -->
    <div class="modal fade" id="deleteQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="question-delete"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="btn-delete-question" value="delete">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Options -->
    <div class="modal fade" id="viewOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Options</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table" style="display: none;">
              <tbody>
                <tr>
                  <td scope="row"><input type="text" class="form-control" id="option" name="option" placeholder="Enter option" value=""></td>
                  <td><label class="checkbox-inline"><input type="checkbox" value=""> Correct Answer</label></td>
                  <td><button type="button" class="btn btn-outline-info btn-sm" id="SaveOption">Save</button></td>
                  <th><button type="button" class="btn btn-outline-danger btn-sm" id="CancelOption">Cancel</button></th>
                </tr>
              </tbody>
            </table>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Option</th>
                  <th scope="col">Correct Answer</th>
                  <th scope="col">Operation</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Jacob</td>
                  <td>No</td>
                  <td><button type="button" class="btn btn-outline-info btn-sm" id="EditOption">Edit</button></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Larry</td>
                  <td>Yes</td>
                  <td><button type="button" class="btn btn-outline-info btn-sm" id="EditOption">Edit</button></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
