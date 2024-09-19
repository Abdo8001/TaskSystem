@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> ncvlxcnvxcnvxcv</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
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
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                           role="tab" aria-controls="home-02"
                           aria-selected="true">{{trans('Students_trans.Student_details')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                           role="tab" aria-controls="profile-02"
                           aria-selected="false">{{trans('Attachments')}}</a>
                    </li>
                </ul>
                  {{-- statr --}}
                  <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                  aria-labelledby="home-02-tab">
                  <section style="background-color: #eee;">
                    <div class="container my-5 py-5">
                      <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10 col-xl-8">
                          <div class="card">
                            <div class="card-body">
                                @foreach ($users->comments as $user)
                              <div class="d-flex flex-start align-items-center">
                                <img class="rounded-circle shadow-1-strong me-3"
                                  src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                  height="60" />
                                <div>
                                  <h6 class="fw-bold text-primary mb-1">{{ $users->name }}</h6>
                                  <p class="text-muted small mb-0">
                                    Shared publicly - Jan 2020
                                  </p>
                                </div>
                              </div>
                              
                          
                              <p class="mt-3 mb-4 pb-2">
                                {{ $user->body }}                             
                              </p>
                              @endforeach
                             
                  
                              <div class="small d-flex justify-content-start">
                                <a href="#!" class="d-flex align-items-center me-3">
                                  <i class="far fa-thumbs-up me-2"></i>
                                  <p class="mb-0">Like</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                  <i class="far fa-comment-dots me-2"></i>
                                  <p class="mb-0">Comment</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                  <i class="fas fa-share me-2"></i>
                                  <p class="mb-0">Share</p>
                                </a>
                              </div>
                            </div>
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                              <div class="d-flex flex-start w-100">
                                <img class="rounded-circle shadow-1-strong me-3"
                                  src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                                  height="40" />
                                <form action="{{ route('comments.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <input type="hidden" name="user_id" value="{{ $task->user_id }}">
                                    <div data-mdb-input-init class="form-outline ">
                                        <input type="text" name="body" id="">
                                        <label class="form-label" for="textAreaExample">Message</label>
                                      </div>
                                    </div>
                                    <div class="float-end mt-2 pt-1">
                                      <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm">Post comment</button>
                                      <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm">Cancel</button>
                                    </div>
                                </form>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
              </div>

                    {{-- end//////////////////////////////////////////////////////////// --}}
                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                aria-labelledby="profile-02-tab">
               <div class="card card-statistics">
                   <div class="card-body">
                    {{-- statr --}}
                    
                    {{-- end --}}
                       {{-- <form method="post" action="{{ route('uploadAttachments') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="col-md-3">
                               <div class="form-group">
                                   <label
                                       for="academic_year">{{trans('Students_trans.Attachments')}}
                                       : <span class="text-danger">*</span></label>
                                   <input type="file" accept="image/*" name="photos[]" multiple required>
                                   <input type="hidden" name="student_name" value="{{$Student->name}}">
                                   <input type="hidden" name="student_id" value="{{$Student->id}}">
                               </div>
                           </div>
                           <br><br>
                           <button type="submit" class="button button-border x-small">
                                  {{trans('Students_trans.submit')}}
                           </button>
                 
                        </form> --}}
                        <table class="table center-aligned-table mb-0 table table-hover"
                        style="text-align:center">
                     <thead>
                     <tr class="table-secondary">
                         <th scope="col">#</th>
                         <th scope="col">{{trans('task name')}}</th>
                         <th>task view</th>
                         <th scope="col">{{trans('Students_trans.created_at')}}</th>
                         <th scope="col">Processes</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($task->images as $attachment)
                         <tr style='text-align:center;vertical-align:middle'>
                             <td>{{$loop->iteration}}</td>
                             <td>{{$attachment->filename}}</td>
                             <td>{{$attachment->created_at->diffForHumans()}}</td>
                             <td><img src="{{ asset('attachments/tasks/'.$task->id.'/'.$attachment->filename) }}" style=" border: 1px solid #ddd;
                                 border-radius: 4px;
                                 padding: 5px; width: 150px;" class="img-rounded img-thumbnail" alt=""></td>
                             <td colspan="2">
                                 <a class="btn btn-outline-info btn-sm"
                                    href="{{url('download_photo')}}/{{ $attachment->imageable_id }}/{{$attachment->filename}}"
                                    role="button"><i class="fas fa-download"></i>&nbsp; Download</a>

                         

                             </td>
                         </tr>
                       {{-- //  @include('pages.student.deleteImage') --}}
                     @endforeach
                     </tbody>
                 </table>
                    </div>
                   <br>
              
               </div>
           </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
