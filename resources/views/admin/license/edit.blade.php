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
                            <h1 class="text-left">ประเภทเผยเเพร่</h1>
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
                                แก้ไขประเภทเผยเเพร่
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                           
                                <form action="{{url('/license/update/'.$license_edit->id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 my-3">
                                            <strong class="col-sm-12">ประเภทเผยเเพร่ สำหรับภาษาไทย :<strong style="color:red;"> * </strong></strong><br>
                                            <input type="text" class="col-sm-12 col-form-label form-control"  name="name_th" id="name_th" value="{{ $license_edit->name_th }}">
                                        </div>
            
                                        <div class="form-group col-xs-12 col-sm-12 col-md-16 my-3">
                                            <strong class="col-sm-12">ประเภทเผยเเพร่ สำหรับภาษาอังกฤษ :<strong style="color:red;"> * </strong></strong><br>
                                            <input type="text" class="col-sm-12 col-form-label form-control" name="name_en" id="name_en" value="{{ $license_edit->name_en }}">
                                        </div>
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
                            <span>ตารางข้อมูล ประเภทเผยเเพร่</span> 
                        </label>

                        <label style="float:right;text-align:right;" class="my-2">
                            <form action="{{url('/license/search/')}}" method="get">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="ค้นหา ประเภทเผยเเพร่..." style="width: 200px">
                                    <span class="input-group-present">
                                        <button type="submit" class="btn btn-primary"  id="btnNavbarSearch">ค้นหา</button>
                                    </span>
                                </div>
                            </form>
                        </label>
                    </div>

                    <div class="card-body">
                        @if($license->count()>0)
                            <table class="table table-responsive ">
                                <thead >
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ประเภทเผยเเพร่ สำหรับภาษาไทย</th>
                                        <th>ประเภทเผยเเพร่ สำหรับภาษาอังกฤษ</th>
                                        <th>จำนวน</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach($license as $row)
                                <tbody>
                                    <tr>
                                        <td><b>{{ $license->firstItem()+$loop->index}}</b></td>
                                        <td class="col-sm-6">{{ $row->name_th}}</td>
                                        <td class="col-sm-6">{{ $row->name_en}}</td>
                                        <td class="col-sm-1"><center>{{ number_format( $row->asset->count() )}}<center></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <div class="pagination-block" style="float:right">
                                {{  $license->appends(request()->input())->links('layouts.paginationlinks') }}
                            </div>
                        @else
                            <h3 class="text text-center" style="color:red">-- ไม่มีข้อมูลประเภทเผยเเพร่ --</h3>
                        @endif

                        <div class="d-flex flex-row-reverse bd-highlight my-4">
                            <a href="/license"  class="btn btn-outline-dark col-sm-1">ย้อนกลับ</a>
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
