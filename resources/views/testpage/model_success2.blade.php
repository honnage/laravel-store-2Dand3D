@extends('layouts.index')
@section('content')
    <div id="layoutSidenav_content">
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
            <div class="container-fluid px-4">
          
                <div class="row">
                    <div class="col-xl-6 my-2">
                        <div class="card mb-4" >
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                รายละเอียดf
                              
                            </div>
                            <div class="card-body" style="background: #17C2A6">
                                {{-- <img src="{{asset('images/'.$fileName)}}" width="120" height="100"> --}}
                                {{-- @foreach ($models as $model)
                                    File Name: {{$model['fileName']}} <br>
                                    File Type: {{$model['fileType']}} <br>
                                    File Size: {{$model['fileSize']}} <br>
                                    <model-viewer src="{{asset('models/'.$fileName)}}" alt="model robot" auto-rotate camera-controls ar ios-src="assets/Drossel.gltf"></model-viewer>
                                    ------------------------------------------
                                    <br>
                                @endforeach --}}

                                @foreach ($models as $model)
                                    File Name: {{$model['fileName']}} <br>
                                    File Type: {{$model['fileType']}} <br>
                                    File Size: {{$model['fileSize']}} <br>
                                   
                                    @if( $model['fileType'] == 'glb' || $model['fileType'] == 'gltf')
                                        <model-viewer src="{{asset('models/'.$model['fileName'])}}" alt="model robot" auto-rotate camera-controls ar ios-src="assets/Drossel.gltf"></model-viewer>
                                    @endif
                                    ------------------------------------------
                                    <br>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 my-2">
                        <div class="card mb-4" >
                            {{-- <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                รายละเอียด
                            </div> --}}
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between">
                                    <div class=" flex-row-reverse  ">
                                        <h1 class="text-left">อัพโหลดชิ้นงาน</h1>
                                    </div>
                                </div>
                           
                                {{-- <form action="{{url('/asset/store/')}}" method="post" enctype="multipart/form-data">

                                    {{csrf_field()}}
                       

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">รูปภาพ :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="file" name="image" value="" class="form-control">
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">ไฟล์ชิ้นงาน :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="file" name="image" value="" class="form-control">
                                    </div>

                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <button type="submit" name="submit" class="btn btn-success col-sm-2">เพิ่มข้อมูล</button>
                                        &nbsp;&nbsp;
                                        <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button>
                                    </div>
                                    
                                </form> --}}
                            </div>
                        </div>
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