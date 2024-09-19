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
                {{ trans('grade_trans.add_Grade') }}
            </button>
            <br><br>
              <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered p-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>task name</th>
                        <th>user </th>

                        <th>Processes</th>
                        <
                    </tr>
                </thead>
                <tbody>
                @foreach ( $tasks as $task )
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->user->name}}</td>
                    <td>       <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#edit{{ $task->id }}"
                        title="edit"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#delete{{ $task->id }}"
                        title="delete"><i
                            class="fa fa-trash"></i></button></td>

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
                    <input id="id" type="hidden" name="id" class="form-control"
                        value="{{ $task->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">close</button>
                        <button type="submit"
                            class="btn btn-danger">delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- edit grade --}}
<div class="modal fade" id="edit{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
              edit task
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- add_form -->
            <form action="{{ route('tasks.update','test') }}" method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col">
                        <input  type="hidden" name="id" value="{{ $task->id }}" class="form-control">

                    </div>
                    <div class="col">
                        <label for="Name_en" class="mr-sm-2">task Name
                            :</label>
                        <input type="text" class="form-control" value="{{ $task->task_name}}" name="task_name">
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
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="Name" class="mr-sm-2">task Name
                            :</label>
                        <input id="Name" type="text" name="task_name" class="form-control">
                    </div>
                    
                </div>
              
                <br><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">close</button>
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
