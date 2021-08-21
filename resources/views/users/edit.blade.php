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

            <div class="col-xl-6 my-4">
                <div class="card mb-4"  id="form_data" >
                    <div class="card-header">
                        ข้อมูลบัญชีของฉัน
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    
                        @if ($users->image != 0)
                            <center><img src="{{url($users->image)}}" style="border-radius: 50%; width: 200px; height: 200px;"></center>
                        @else
                            <center><div style="background:#979797; border-radius: 50%; width: 200px; height: 200px; "></div></center>
                        @endif
                    
                        <form action="{{url('/users/update/'.$users->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group col-xs-12 col-sm-12 col-md-12 my-3">
                                <strong class="col-sm-12">อีเมล :</strong><br>
                                <input type="text" class="col-sm-12 col-form-label form-control"  name="email" id="email"  value="{{$users->email}}" readonly>
                            </div>
                
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 my-3">
                                <strong class="col-sm-12">ชื่อจริง :</strong><br>
                                <input type="text" class="col-sm-12 col-form-label form-control"  name="firstname" id="firstname"  value="{{$users->firstname}}">
                            </div>

                            <div class="form-group col-xs-12 col-sm-12 col-md-16 my-3">
                                <strong class="col-sm-12">นามสกุล :</strong><br>
                                <input type="text" class="col-sm-12 col-form-label form-control" name="lastname" id="lastname" value="{{$users->lastname}}">
                            </div>

                            <div class="form-groupcol-xs-12 col-sm-12 col-md-16 my-3">
                                <strong class="col-sm-12">รูปภาพ :<strong style="color:red;"> * </strong></strong><br>
                                <input type="file" name="image" value="{{$users->image}}" class="form-control">
                            </div>

                            <div class="d-flex flex-row-reverse bd-highlight form-group my-4">
                                <button type="submit" name="submit" class="btn btn-success col-sm-2">อัพเดทข้อมูล</button>
                                &nbsp;&nbsp;
                                <button class="btn btn-secondary col-sm-1" width="100%" type="reset">ยกเลิก</button>
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