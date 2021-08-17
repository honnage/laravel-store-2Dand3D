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
                <div class="col-xl-12 my-2">
                    <div class="d-flex justify-content-between">
                        <div class=" flex-row-reverse  ">
                            <h1 class="text-left">ชิ้นงานในระบบ</h1>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                   
                    <div class="card-header" style="background: rgb(65, 62, 57); color: white; font-size: 18px">
                 
                        <label class="my-2">
                            <i class="fas fa-table me-1"></i>
                            <span>ตารางข้อมูล ชิ้นงานในระบบ</span> 
                        </label>

                        <label style="float:right;text-align:right;" class="my-2">
                            <form action="{{url('/license/search/')}}" method="get">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="ค้นหา ชิ้นงานในระบบ..." style="width: 200px">
                                    <span class="input-group-present">
                                        <button type="submit" class="btn btn-primary"  id="btnNavbarSearch">ค้นหา</button>
                                    </span>
                                </div>
                            </form>
                        </label>
                    </div>

                    <div class="card-body">
                        @if($asset->count()>0)
                            <table class="table table-responsive ">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th><center>รูปภาพ</center></th>
                                        <th><center>ผู้้เผยแพร่</center></th>
                                        <th><center>ชื่อชิ้นงาน</center></th>
                                        <th><center>หมวดหมู่</center></th>
                                        <th><center>ประเภทนามสกุลไฟล์</center></th>
                                        <th><center>ราคา</center></th>
                                        <th><center>รายละเอียด</center></th>
                                    </tr>
                                </thead>
                                @foreach($asset as $row)
                                <tbody>
                                    <tr>
                                        <td><b>{{ $asset->firstItem()+$loop->index}}</b></td>
                                        <td><img src="{{url($row->image)}}"  width="80px" height="80px"></td> 
                                        <td class="col-sm-2">{{ $row->user->firstname}} {{ $row->user->lastname}}</td> 
                                        <td class="col-sm-3">{{ $row->display_name}}</td> 
                                        <td class="col-sm-2"><center>{{ $row->category->name_th}}<center></td> 
                                        <td class="col-sm-2"><center>{{ $row->typefile->name}} / {{ $row->typefile->formats}}</center></td> 
                                        <td class="col-sm-1" style="text-align:right;">{{ number_format( $row->price )}}</td>
                                        <td class="col-sm-2">
                                            <center><a class="btn btn-warning col-sm-12" style="width: 50px" href="{{url('/license/edit/'.$row->id)}}"><i class="far fa-edit"></i></a></center>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <div class="pagination-block">
                                {{  $asset->appends(request()->input())->links('layouts.paginationlinks') }}
                            </div>
                        @else
                            <h3 class="text text-center" style="color:red">-- ไม่มีข้อมูลชิ้นงานในระบบ --</h3>
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
