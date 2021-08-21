@extends('layouts.index')
@section('content')
<div id="layoutSidenav_content" style="background: #f8f8f8">
    <main>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session()->has('warning'))
            <div class="alert alert-danger" role="alert">
                {{Session()->get('warning')}}
            </div>
        @endif
        @if(Session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{Session()->get('success')}}
            </div>
        @endif
        <div class="container-fluid px-4 ">
        
        <div class="row">
            <div class="col-xl-3 my-2">
            </div>

            <div class="col-xl-6 my-2">
                <div class="card mb-4" >
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <div class=" flex-row-reverse  ">
                                <h1 class="text-left">รายงาน: {{$asset->display_name}}</h1>
                            </div>
                        </div>
                      
                        <form action="{{url('/report/store',$asset->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                     
                            {{-- show image or model --}}
                            <div class="my-4">
                                <img src="{{url($asset->image)}}" width="100%" height="100%">
                                @if($asset->model_path != null )
                                    <model-viewer  class="my-2" width="100%" height="100%" src="{{asset($asset->model_path)}}"  auto-rotate camera-controls  style="background: #17C2A6;"></model-viewer>
                                @endif
                            </div>

                            <div class="form-group my-4">
                                <strong class="col-sm-12">คำอธิบาย :<strong style="color:red;"> * </strong></strong><br>
                                <input id="x" type="hidden" name="description">
                                <trix-editor input="x"></trix-editor>
                            </div>

                            <div class="d-flex flex-row-reverse bd-highlight">
                                <button type="submit" name="submit" class="btn btn-success col-sm-2">รายงาน</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 my-2">
            </div>
        </div>
        
        </div>
    </main>
    {{-- <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2021</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer> --}}
</div>
@endsection