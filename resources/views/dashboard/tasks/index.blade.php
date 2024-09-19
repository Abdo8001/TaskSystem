@extends('layouts.master')
@section('css')
    {{-- @toastr_css --}}
@endsection
@section('title')
    tasks
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        {{-- add msg --}}
        @if (session()->has('add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- delete msg --}}
        @if (session()->has('delete'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- edit msg --}}
        @if (session()->has('edit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('edit') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- warn msg --}}
        @if (session()->has('warn'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('warn') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">

            <div class="col-sm-6">
                <h4 class="mb-0"> tasks</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">tasks</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    {{-- start search --}}
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Search Admin</h3>
    </div>
    <form method="get" action="">
      <div class="card-body">
        <div class="row">
          
        @csrf
        <div class="form-group col-md-3">
          <label>Task Name</label>
          <input type="text" class="form-control" value="{{ Request::get('task_name') }}" name="task_name" placeholder="Name">
        </div>
        {{-- <div class="form-group col-md-3">
          <label>user</label>
          <input type="text" class="form-control" name="user_name" value="{{ Request::get('user_name') }}" placeholder="Email">
        </div> --}}
  
          <div class="form-group col-md-3">
          <label>Date</label>
          <input type="date" class="form-control" name="date" value="{{ Request::get('created_at') }}" placeholder="Email">
        </div>
  
        <div class="form-group col-md-3">
          <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
          <a href="{{ route('tasks.index') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
  
        </div>
  
        </div>
      </div>
    </form>
  </div>
  {{-- start search --}}
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        add task
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>task name</th>
                                    <th>user </th>
                                    <th> {{ auth()->user()->user_type==1?'':'task Status' }}</th>
                                    <th>Processes</th>
                                    < </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $task->task_name }}</td>
                                        <td>{{ $task->user->name }}</td>

                                        @if (auth()->user()->user_type == 1)
                                            <td> <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $task->id }}" title="editStatus"><i
                                                        class="fa fa-edit"></i></button></td>
                                        @else
                                          {{-- <td  class="{{$task->status==0?'background-color:green;':'background-color:red;' }}"></td> --}}

                                          <td class="{{$task->status==0?'bg-success text-white':'bg-danger text-white' }}">{{ $task->status==0?'done':'not done' }}</td>
                                            <td> <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $task->id }}" title="edit"><i
                                                        class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $task->id }}" title="delete"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        @endif
                                    </tr>
                                    {{-- delete model --}}
                                    <div class="modal fade" id="delete{{ $task->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('grade_trans.delete_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        warining
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $task->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">close</button>
                                                            <button type="submit" class="btn btn-danger">delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- edit grade --}}
                                    <div class="modal fade" id="edit{{ $task->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        edit task
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('tasks.update', 'test') }}" method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="hidden"  name="id"
                                                                    value="{{ $task->id }}" class="form-control">
                                                                  
                                                                </div>
                                                            <div class="col">
                                                                <label for="Name_en" class="mr-sm-2">task Name
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $task->task_name }}"  {{ auth()->user()->user_type==1?'readonly':'' }} name="task_name">
                                                            </div>
                                                         
                                                            
                                                        </div>
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioDefault1">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                  task not done
                                                                </label>
                                                              </div>
                                                              <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioDefault2" >
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                 task done
                                                                </label>
                                                              </div>
                                                        </div>

                                                        <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">submit</button>
                                                </div>
                                                </form>

                                            </div>
                                        </div>
                                        {{-- edit status --}}

                                        <div class="modal fade" id="status{{$task->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            edit task
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- add_form -->
                                                        <form action="{{ route('tasks.update', 'test') }}" method="POST">
                                                            @csrf
                                                            @method('patch')
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $task->id }}" class="form-control">

                                                                </div>
                                                                <div class="col">
                                                                    <label for="Name_en" class="mr-sm-2">task status
                                                                        :</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $task->status }}" name="task_name">

                                                                    <input type="checkbox" name="status" id="">
                                                                </div>
                                                            </div>

                                                            <br><br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">submit</button>
                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                            {{-- edit status --}}
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>

                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            create task
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">task Name
                                        :</label>
                                    <input id="Name" type="text" name="task_name" class="form-control">
                                </div>

                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">assign task</label>
                                <select multiple name="user_id[]" class="form-control" id="exampleFormControlSelect2">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br><br>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="file"  name="tasks[]" multiple>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-success">submit</button>
                    </div>
                    </form>

                </div>
            </div>


        </div>




    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

