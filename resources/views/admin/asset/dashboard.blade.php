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
                <div class="col-xl-12 my-4">
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
                            <form action="{{url('/asset/search/')}}" method="get">
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
                                        <th><center>โมเดล</center></th>
                                        <th><center>ผู้เผยแพร่</center></th>
                                        <th><center>ชื่อชิ้นงาน</center></th>
                                        <th><center>หมวดหมู่</center></th>
                                        <th><center>นามสกุลไฟล์</center></th>
                                        <th><center>รูปแบบ</center></th>
                                        <th><center>ราคา</center></th>
                                        <th><center>แสดงชิ้นงาน</center></th>
                                        <th><center>ดาวน์โหลด</center></th>
                                        <th><center>รายงาน</center></th>
                                        <th><center>รายละเอียด</center></th>
                                        <th><center>แก้ไข</center></th>
                                    </tr>
                                </thead>
                                @foreach($asset as $row)
                                <tbody>
                                    <tr>
                                        <td><b>{{ $asset->firstItem()+$loop->index}}</b></td>
                                        <td class="col-sm-1"><a href="{{url('/asset/detail/'.$row->id)}}" class="dropdown-item"><img src="{{url($row->image)}}"  width="200px" height="150px"></a></td> 
                                    
                                        @if ($row->model_path == null)
                                            <td class="col-sm-1" style="background: #a0a0a0;"></td> 
                                        @else
                                            <td class="col-sm-1"><model-viewer src="{{url($row->model_path)}}"  auto-rotate camera-controls  style="background: #17C2A6; width:200px;"></model-viewer></td> 
                                        @endif
                                        <td class="col-sm-1"><b>{{ $row->user->firstname}} {{ $row->user->lastname}}</b></td> 
                                        <td class="col-sm-1"><a href="{{url('/asset/detail/'.$row->id)}}" class="dropdown-item"> {{ $row->display_name }}</a></td> 
                                        <td class="col-sm-1"><center>{{ $row->category->name_th}}<center></td> 
                                        <td class="col-sm-1"><center>{{ $row->typefile->name}}</center></td> 
                                        <td class="col-sm-1"><center>{{ $row->typefile->formats}}</center></td> 
                                        <td class="col-sm-1" style="text-align:right;">{{ number_format( $row->price )}}</td>
                                        @if($row->status_show == 0)
                                            <td class="col-sm-2"><center>รูปภาพ</center></td> 
                                        @elseif ($row->status_show == 1)   
                                            <td class="col-sm-2"><center>โมเดล</center></td>
                                        @else
                                            <td class="col-sm-2"><center>ปิดการแสดง</center></td>
                                        @endif
                                        <td class="col-sm-1"><center>{{number_format( $row->download->count() )}}<center></td>
                                        <td class="col-sm-1"><center>{{number_format( $row->report->count() )}}<center></td>

                                        <td class="col-sm-2">
                                            @if ($row->report->count() > 0)
                                            <center>
                                                <a class="btn btn-primary col-sm-12" style="width: 50px" href="{{url('/report/datails/'.$row->id)}}"><i class="fas fa-eye"></i></a>
                                            </center>
                                            @endif
                                        </td>
                                        <td class="col-sm-2">
                                            <center>
                                                <a class="btn btn-warning col-sm-12" style="width: 50px" href="{{url('/report/edit/'.$row->id)}}"><i class="far fa-edit"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <div class="pagination-block" style="float:right">
                                {{ $asset->appends(request()->input())->links('layouts.paginationlinks') }}
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
