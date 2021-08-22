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
            <div class="col-xl-3 my-4">
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
                                <h1 class="text-left"> {{isset($asset)? "แก้ไขชิ้นงาน":"อัพโหลดชิ้นงาน"}}</h1>
                            </div>
                            
                        </div>
                      
                        @if (isset($asset) != null)
                            <img src="{{url($asset->image)}}"  width="100%" height="100%">
                            @if ($asset->status_show == 1 )
                                <div style="background: #17C2A6;" height="800px" class="my-4">
                                    <model-viewer src="{{asset($asset->model_path)}}"  auto-rotate camera-controls ar width="auto"></model-viewer>
                                </div>
                            @endif
                        @endif

                        <form action="{{isset($asset)?"/asset/update/$asset->id" :url("/asset/store")}} " method="post" enctype="multipart/form-data">

                            {{csrf_field()}}
                            <div class="form-group my-2">
                                <strong class="col-sm-12">ชื่อชิ้นงาน :<strong style="color:red;"> * </strong></strong><br>
                                <input type="text" class="col-sm-12 col-form-label form-control"  name="display_name" id="display_name" value="{{isset($asset)?"$asset->display_name":' '}}" >
                            </div>

                            <div class="form-group my-4">
                                <strong class="col-sm-12">คำอธิบาย :<strong style="color:red;"> * </strong></strong><br>
                                <input id="x" value="{{isset($asset)?"$asset->description":''}}" type="hidden" name="description">
                                <trix-editor input="x"></trix-editor>
                            </div>

                            <div class="form-group my-4">
                                <strong class="col-sm-12">ราคา :<strong style="color:red;"> * </strong></strong><br>
                                <input type="text" class="col-sm-12 col-form-label form-control"  name="price" id="price" value="{{isset($asset)?"$asset->price":' '}}" >
                            </div>

                            <div class="form-group my-4">
                                <strong class="col-sm-12">หมวดหมู่ :<strong style="color:red;"> * </strong></strong><br>
                                <select class="form-control" name="category_id">
                                    <option value="" style="color:red;">--- กรุณาเลือกหมวดหมู่ --- </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            @if(isset($asset))
                                                @if($asset->category_id == $asset->category_id)
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
                                            @if(isset($asset))
                                                @if($asset->typefile_id == $typefile->id)
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
                                            @if(isset($asset))
                                                @if($asset->license_id == $license->id)
                                                    selected
                                                @endif
                                            @endif
                                        >{{$license->name_th}} / {{$license->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if (isset($asset) != null )
                                <div class="form-group my-4">
                                    <strong class="col-sm-12">แสดงชิ้นงาน :<strong style="color:red;"> * </strong></strong><br>
                                    <select class="form-control" name="status_show">
                                        @if($asset->model_path != null)
                                            @if($asset->status_show == 0)
                                                <option value="0" style="color:red;"> แสดงรูป</option>
                                            @else
                                                <option value="1"> แสดงโมเดล</option>
                                            @endif

                                            @if($asset->status_show != 0)
                                                <option value="0" style="color:red;"> แสดงรูป</option>
                                            @else
                                                <option value="1"> แสดงโมเดล</option>
                                            @endif
                                        @else
                                            <option value="0" style="color:red;"> 
                                                แสดงรูป
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            @endif

                            @if (isset($asset) == 0 )
                                <div class="form-group my-4">
                                    <strong class="col-sm-12">รูปภาพ :<strong style="color:red;"> * </strong></strong><br>
                                    <input type="file" name="image" value="" class="form-control">
                                </div>

                                <div class="form-group my-4">
                                    <strong class="col-sm-12">ไฟล์ชิ้นงาน :<strong style="color:red;"> * jpg jpeg png zip rar gltf glb  </strong></strong><br>
                                    <input type="file" name="asset" value="" class="form-control">
                                </div>

                                <div class="form-group my-4">
                                    <strong class="col-sm-12">แสดงตัวอย่างโมเดลสำหรับไฟล์ gltf หรือ glb :</strong><br>
                                    <input type="file" name="model" value="" class="form-control">
                                </div>
                            @endif
                            

                            <div class="d-flex flex-row-reverse bd-highlight">
                                <input type="submit" name="submit" value="{{isset($asset)? "อัพเดทข้อมูล":"เพิ่มข้อมูล"}}" class="btn btn-success col-sm-3" width="100%">
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