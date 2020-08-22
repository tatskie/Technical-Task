@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Exam Table') }}
                    <button type="button" class="btn btn-outline-primary float-right" id="btn-add">Add exam</button>
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
                          <th scope="col">Exam Title</th>
                          <th scope="col">Operation</th>
                        </tr>
                      </thead>
                      <tbody id="exam-lists" name="exam-lists">
                          @foreach ($exam as $data)
                            <tr id="exam{{$data->id}}">
                                <td scope="row">{{$data->id}}</td>
                                <td>{{$data->title}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm" id="examView" data-id="{{$data->id}}">view</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="examEdit" data-id="{{$data->id}}">Edit</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" id="examDelete" data-id="{{$data->id}}">Delete</button>
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
    <div class="modal fade" id="ExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="new-exam">Add New Exam</h5>
            <h5 class="modal-title" id="update-exam">Update Exam</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" role="alert" id="error" style="display: none;">
              Whoops! Something went wrong!
            </div>
            <form id="examForm" name="examForm" class="form-horizontal" novalidate="">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter title" value="">
                    <span class="invalid-feedback" role="alert" id="title-error">
                        <strong id="title-error-message"></strong>
                    </span>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="exam_id" name="exam_id" value="0">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save</button>
            <button type="button" class="btn btn-primary" id="btn-update" value="update">Update</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Exam -->
    <div class="modal fade" id="deleteExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Exam</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="exam-delete"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="btn-delete" value="delete">Delete</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
