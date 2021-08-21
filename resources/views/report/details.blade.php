@extends('layouts.index')
@section('content')
    <div id="layoutSidenav_content" style="background: #f8f8f8">
        <main >
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
                            <h1 class="text-left">รายละเอียดการรายงาน</h1>
                        </div>
                       
                    </div>
                </div>
                

                <div class="card mb-4">
                   
                    <div class="card-header" style="background: rgb(65, 62, 57); color: white; font-size: 18px">
                 
                        <label class="my-2">
                            <i class="fas fa-table me-1"></i>
                            <span>ตารางข้อมูล การรายงานของชิ้นงาน {{$asset->display_name}}</span> 
                        </label>

                        <label style="float:right;text-align:right;" class="my-2">
                            <form action="{{url('/report/search/'.$asset->id)}}" method="get">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="ค้นหา รายงาน..." style="width: 200px">
                                    <span class="input-group-present">
                                        <button type="submit" class="btn btn-primary"  id="btnNavbarSearch">ค้นหา</button>
                                    </span>
                                </div>
                            </form>
                        </label>
                    </div>

                    <div class="card-body">
                        @if($report->count()>0)
                            <table class="table table-responsive ">
                                <thead >
                                    <tr>
                                        <th>ลำดับ</th>
                                        @if(Auth::user()->isStatus == 10 || Auth::user()->id == 1)
                                            <th>ผู้รายงาน</th>
                                        @endif
                                        <th>คำอธิบาย</th>
                                        <th><center>วันที่รายงาน</center></th>
                                    </tr>
                                </thead>
                                @foreach($report as $row)
                                <tbody>
                                    <tr>
                                        <td><b>{{ $report->firstItem()+$loop->index}}</b></td>
                                        @if(Auth::user()->isStatus == 10 || Auth::user()->id == 1)
                                            <td class="col-sm-1">{{ $row->user->firstname}} {{ $row->user->lastname}}</td>
                                        @endif
                                        <td class="col-sm-9">{!!$row->description!!}    </td>
                                        <td class="col-sm-3"><center>{{ $row->created_at}}</center></td>
                                      
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            <div class="pagination-block" style="float:right">
                                {{  $report->appends(request()->input())->links('layouts.paginationlinks') }}
                            </div>
                        @else
                            <h3 class="text text-center" style="color:red">-- ไม่มีข้อมูลการรายงาน --</h3>
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
