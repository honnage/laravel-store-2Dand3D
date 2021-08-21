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
            @if(Session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session()->get('error')}}
                </div>
            @endif
            <div class="container-fluid px-4">
                <div class="col-xl-12 my-4">
                    <div class="d-flex justify-content-between">
                        <div class=" flex-row-reverse  ">
                            <h1 class="text-left">ประเภทนามสกุลไฟล์</h1>
                        </div>
                        <div class="d-flex flex-row-reverse  ">
                            <button href="#" class=" slideToggle_table btn btn-outline-success" >ฟอร์มข้อมูล </button>
                            {{-- <button href="#" class="slideToggle_table btn btn-outline-success" >กราฟ </button> --}}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 my-2">
                        <div class="card mb-4"  id="form_data" >
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                แก้ไขประเภทนามสกุลไฟล์
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                           
                                <form action="{{url('/typefile/update/'.$typefile_edit->id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                        
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 my-3">
                                        <strong class="col-sm-12">ประเภทนามสกุลไฟล์ :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="text" class="col-sm-12 col-form-label form-control"  name="name" id="name"  value="{{ $typefile_edit->name }}">
                                    </div>
        
                                    <div class="form-group col-xs-12 col-sm-12 col-md-16 my-3">
                                        <strong class="col-sm-12">คำอธิบาย :<strong style="color:red;"> * </strong></strong><br>
                                        <input type="text" class="col-sm-12 col-form-label form-control" name="description" id="description" value="{{ $typefile_edit->description }}">
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-12 col-md-16 my-3">
                                    
                                        <strong class="col-sm-12">หมวดหมู่ :<strong style="color:red;"> * </strong></strong><br>
                                        <select class="form-control" name="formats">
                                            <option value="{{ $typefile_edit->formats }}" style="color:red;">{{ $typefile_edit->formats }}</option>
                                            @if($typefile_edit->formats == "3D")
                                                <option name="formats" value="2D">2D</option>
                                            @endif
                                     
                                            @if($typefile_edit->formats == "2D")
                                                <option name="formats" value="3D">3D</option>
                                            @endif
                                        </select>
                                    </div>
                            
                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <button type="submit" name="submit" class="btn btn-success col-sm-2">อัพเดทข้อมูล</button>
                                        &nbsp;&nbsp;
                                        <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                   
                    <div class="card-header" style="background: rgb(65, 62, 57); color: white; font-size: 18px">
                        <label class="my-2">
                            <i class="fas fa-table me-1"></i>
                            <span>ตารางข้อมูล ประเภทนามสกุลไฟล์</span> 
                        </label>

                        <label style="float:right;text-align:right;" class="my-2">
                            <form action="{{url('/typefile/search/')}}" method="get">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="ค้นหา ประเภทนามสกุลไฟล์..." style="width: 200px">
                                    <span class="input-group-present">
                                        <button type="submit" class="btn btn-primary"  id="btnNavbarSearch">ค้นหา</button>
                                    </span>
                                </div>
                            </form>
                        </label>
                    </div>

                    <div class="card-body">
                        @if($typefile->count()>0)
                            <table class="table table-responsive ">
                                <thead >
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>นามสกุลไฟล์</th>
                                        <th>รูปแบบ</th>
                                        <th>คำอธิบาย</th>
                                        <th>จำนวน</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach($typefile as $row)
                                <tbody>
                                    <tr>
                                        <td><b>{{ $typefile->firstItem()+$loop->index}}</b></td>
                                        <td class="col-sm-2">{{ $row->name}}</td>
                                        <td class="col-sm-2">{{ $row->formats}}</td>
                                        <td class="col-sm-8">{{ $row->description}}</td>
                                        <td class="col-sm-1"><center>{{ number_format( $row->asset->count() )}}<center></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <div class="pagination-block" style="float:right">
                                {{  $typefile->appends(request()->input())->links('layouts.paginationlinks') }}
                            </div>
                        @else
                            <h3 class="text text-center" style="color:red">-- ไม่มีข้อมูลประเภทนามสกุลไฟล์ --</h3>
                        @endif

                        <div class="d-flex flex-row-reverse bd-highlight my-4">
                            <a href="/typefile"  class="btn btn-outline-dark col-sm-1">ย้อนกลับ</a>
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
