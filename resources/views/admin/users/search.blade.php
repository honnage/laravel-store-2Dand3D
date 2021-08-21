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
            <div class="container-fluid px-4">
                <div class="col-xl-12 my-4">
                    <div class="d-flex justify-content-between">
                        <div class=" flex-row-reverse  ">
                            <h1 class="text-left">ผู้ใช้งานในระบบ</h1>
                        </div>
                    </div>
                </div>
    
                <div class="card mb-4">
                    <div class="card-header" style="background: rgb(65, 62, 57); color: white">
                        <label class="my-2">
                            <i class="fas fa-table me-1"></i>
                            <span>ตารางข้อมูล ผู้ใช้งานในระบบ</span> 
                        </label>
                       
                        <label class="float-end my-2">
                            <form action="{{url('/users/search/')}}" method="get">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="ค้นหา ข้อมูลผู้ใช้..." style="width: 200px">
                                    <span class="input-group-present">
                                        <button type="submit" class="btn btn-primary"  id="btnNavbarSearch">ค้นหา</button>
                                    </span>
                                </div>
                            </form>
                        </label>
                    </div>
                    <div class="card-body">
                        @if($users->count()>0)
                            <table class="table table-responsive ">
                                <thead >
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อจริง - นามสกุล</th>
                                        <th>อีเมล</th>
                                        <th><center>ผลงาน</center></th>
                                        <th>สถานะ</th>
                                        @if(Auth::user()->isStatus == 10 || Auth::user()->id == 1)
                                            <th><center>แก้ไขสิทธิ์</center></th>
                                        @endif
                                        <th><center>รายละเอียด</center></th>
                                    </tr>
                                </thead>
                                @foreach($users as $row)
                                <tbody>
                                    <tr>
                                        <td><b>{{ $users->firstItem()+$loop->index}}</b></td>
                                        <td class="col-sm-4">{{ $row->firstname}} {{ $row->lastname}}</td>
                                        <td class="col-sm-4">{{ $row->email}}</td>
                                        <td class="col-sm-2"><center>{{ number_format( $row->asset->count() )}}<center></td>
                                        <td class="col-sm-2">
                                            @if($row->isStatus == 10 || $row->id == 1)
                                                ผู้ดูแลระบบ
                                            @elseif($row->isStatus == 5)
                                                เจ้าหน้าที่
                                            @else
                                                ผู้ใช้งาน
                                            @endif 
                                        </td>
                                        @if(Auth::user()->isStatus == 10 || Auth::user()->id == 1)
                                            <td>
                                                <a class="btn btn-warning col-sm-12" style="width: 50px" href="{{url('/users/edit-status/'.$row->id)}}"><i class="far fa-edit"></i></a>
                                            </td>
                                        @endif
                                        <td>
                                            <a class="btn btn-primary col-sm-12" style="width: 50px" href="{{url('/asset/dashboard/'.$row->id)}}"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <div class="pagination-block" style="float:right">
                                {{  $users->appends(request()->input())->links('layouts.paginationlinks') }}
                            </div>
                        @else
                            <h3 class="text text-center" style="color:red">-- ไม่มีข้อมูลผู้ใช้ในระบบ --</h3>
                        @endif

                        <div class="d-flex flex-row-reverse bd-highlight my-4">
                            <a href="/users"  class="btn btn-outline-dark col-sm-1">ย้อนกลับ</a>
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
