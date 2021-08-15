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
                                รายละเอียด
                            </div>
                            <div class="card-body" style="background: #17C2A6">
                                <model-viewer src="{{ asset('models/crocodile/scene.gltf') }}" alt="model robot" auto-rotate camera-controls ar ios-src="assets/Drossel.gltf"></model-viewer>
                                {{-- <model-viewer src="{{ asset('models/nissan/scene.gltf') }}" alt="model robot" auto-rotate camera-controls ar ios-src="assets/Drossel.gltf"></model-viewer> --}}
                                 {{-- <model-viewer src="{{ asset('assets/Drossel.gltf') }}" alt="model robot" auto-rotate camera-controls ar ios-src="assets/Drossel.gltf"></model-viewer> --}}
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
                           
                                <form action="{{url('/asset/store/')}}" method="post" enctype="multipart/form-data">

                                    {{csrf_field()}}
                                    <div class="form-group my-2">
                                        <strong class="col-sm-12">ชื่อชิ้นงาน :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="text" class="col-sm-12 col-form-label"  name="display_name" id="display_name" placeholder="เช่น ชื่อชิ้นงานที่จะอัพโหลด ">
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">คำอธิบาย :<strong style="color:red;"> * </strong></strong><br>
                                        <input id="x" value="{{isset($posts)?"$posts->content":''}}" type="hidden" name="description">
                                        <trix-editor input="x"></trix-editor>
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">ราคา :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="text" class="col-sm-12 col-form-label"  name="price" id="price" placeholder="เช่น ชื่อชิ้นงานที่จะอัพโหลด ">
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">หมวดหมู่ :<strong style="color:red;"> * </strong></strong><br>
                                        <select class="form-control" name="category_id">
                                            <option value="" style="color:red;">--- กรุณาเลือกหมวดหมู่ --- </option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                    @if(isset($posts))
                                                        @if($category->id == $posts->category_id)
                                                            selected
                                                        @endif
                                                    @endif
                                                >{{$category->name_th}} / {{$category->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">ประเภทนามสกุลไฟล์ :<strong style="color:red;"> * </strong></strong><br>
                                        <select class="form-control js-example-basic-multiple" name="typefile_id" id="select-tags">
                                            <option value="" style="color:red;">--- กรุณาเลือกหมวดหมู่ ---</option>    
                                            @foreach($typefiles as $typefile)
                                                <option value="{{$typefile->id}}"
                                                    @if(isset($posts))
                                                        @if($posts->hasTag($typefile->id))
                                                            selected
                                                        @endif
                                                    @endif
                                                >{{$typefile->formats}} / {{$typefile->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">ประเภทเผยเเพร่ :<strong style="color:red;"> * </strong></strong><br>
                                        <select class="form-control js-example-basic-multiple" name="license_id" id="select-tags">
                                            <option value="" style="color:red;">--- กรุณาเลือกประเภทเผยเเพร่ ---</option>    
                                            @foreach($licenses as $license)
                                                <option value="{{$license->id}}"
                                                    @if(isset($posts))
                                                        @if($posts->hasTag($license->id))
                                                            selected
                                                        @endif
                                                    @endif
                                                >{{$license->name_th}} / {{$license->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">รูปภาพ :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="file" name="image" value="" class="form-control">
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">ไฟล์ชิ้นงาน :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="file" name="asset" value="" class="form-control">
                                    </div>

                                    <div class="form-group my-4">
                                        <strong class="col-sm-12">แสดงตัวอย่างโมเดลสำหรับไฟล์ gltf หรือ glb :</strong><br>
                                        <input type="file" name="path_model" value="" class="form-control">
                                    </div>

                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <button type="submit" name="submit" class="btn btn-success col-sm-2">เพิ่มข้อมูล</button>
                                        &nbsp;&nbsp;
                                        <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button>
                                    </div>
                                    
                                </form>
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