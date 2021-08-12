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
                <h1 class="mt-4">ประเภทนามสกุลไฟล์</h1>
                <div class="row">
                    <div class="col-xl-12 my-2">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                เพื่มประเภทนามสกุลไฟล์
                                {{-- <a href="<?php echo $path ?>" class="btn btn-primary">hoooo</a> --}}
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="/typefile/store" method="post" >
                                    {{csrf_field()}}
                                    <div class="row form-inline">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 my-3">
                                            <strong class="col-sm-12">ประเภทนามสกุลไฟล์ :<strong style="color:red;"> * </strong></strong><br>
                                            <input type="text" class="col-sm-12 col-form-label"  name="name" id="name" placeholder="เช่น odj ">
                                         </div>
            
                                         <div class="form-group col-xs-12 col-sm-12 col-md-16 my-3">
                                            <strong class="col-sm-12">คำอธิบาย :<strong style="color:red;"> * </strong></strong><br>
                                            <input type="text" class="col-sm-12 col-form-label" name="description" id="description" placeholder="เช่น เป็นรูปแบบไฟล์ที่ใช้สำหรับวัตถุสามมิติที่มีพิกัด 3D ">
                                        </div>
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
                <div class="card mb-4">
                    <div class="card-header" style="background: rgb(65, 62, 57); color: white">
                        <i class="fas fa-table me-1"></i>
                        ตารางข้อมูล ประเภทนามสกุลไฟล์
                    </div>
                    <div class="card-body">
                        @if($typefile->count()>0)
                            <table class="table table-responsive ">
                                <thead >
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ประเภทนามสกุลไฟล์</th>
                                        <th>คำอธิบาย</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach($typefile as $tf)
                                <tbody>
                                    <tr>
                                        <td><b>{{ $typefile->firstItem()+$loop->index}}</b></td>
                                        <td class="col-sm-6">{{ $tf->name}}</td>
                                        <td class="col-sm-6">{{ $tf->description}}</td>
                                        <td>
                                            <a class="btn btn-warning col-sm-12" href="typefile/edit/{{$tf->id}}">แก้ไข</a>
                                        </td>
                                        <td>
                                            <form class="delete_form" action="typefile/destroy/{{$tf->id}}" method="post">
                                                {{csrf_field()}}
                                                <input type="submit" value="ลบ" data-name="{{$tf->name}}" class="btn btn-danger deleteform">
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <div class="pagination-block">
                                {{  $typefile->appends(request()->input())->links('layouts.paginationlinks') }}
                            </div>
                        @else
                            <h3 class="text text-center" style="color:red">-- ไม่มีข้อมูลประเภทนามสกุลไฟล์ --</h3>
                        @endif
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
