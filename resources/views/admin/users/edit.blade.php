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
                <div class="card mb-4" >
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row form-inline">
                            {{-- display name --}}
                            <div class="d-flex justify-content-between">
                                <div class=" flex-row-reverse  ">
                                    <h1 class="text-left"> </h1>
                                </div>                            
                            </div>

                      


                             {{-- full name --}}
                             <div class="form-group col-xs-12 col-sm-12 col-md-12 my-2">
                                <strong class="col-sm-3">จำนวนดาวน์โหลด  </strong>
                                {{-- {{number_format( $asset->download->count())}} ครั้ง --}}
                            </div>

                            {{-- full name --}}
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 my-2">
                                <strong class="col-sm-3">ผู้อัพโหลด  </strong>
                                {{-- {{$asset->user->firstname}} {{$asset->user->lastname}} --}}
                            </div>

                            {{-- price --}}
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 my-2">
                                <strong class="col-sm-3">ราคา  </strong>
                                {{-- <label >{{$asset->price}} บาท</label> --}}
                            </div>

                            {{-- description --}}
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 my-2">
                                <strong class="col-sm-3">คำอธิบาย  </strong>
                                {{-- {!!$asset->description!!}     --}}
                            </div>

                            {{-- license --}}
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 my-2">
                                <strong class="col-sm-3">ประเภทการเผยเเพร่ </strong>
                                {{-- <label >{{$asset->license->name_th}}</label> --}}
                            </div>

                            {{-- date  --}}
                            {{-- <div class="form-group col-xs-12 col-sm-12 col-md-12 my-4">
                                <strong class="col-sm-3">วันที่แก้ไขล่าสุด </strong><span class="col-sm-9">{{$asset->updated_at}}</span>
                                <strong class="col-sm-3">วันที่อัพโหลด </strong><span class="col-sm-9">{{$asset->created_at}}</span>
                            </div> --}}
                  
                        
                        </div>
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