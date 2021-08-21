@extends('layouts.index')
@section('content')
    <div id="layoutSidenav_content" style="background: #f8f8f8">
        <main>
            <section >
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
                {{-- <div class="container" data-aos="fade-up"> --}}
                    <div class="row my-2">
                        @if($asset->count()>0)
                            @foreach( $asset as $row) 
                                @if($row->status_show == "0" || $row->status_show == "1")

                                <div class="col-lg-3 col-md-2 my-4" data-aos="fade-up"  >
                                    <div class="card" style="border-radius: 25px; background: #fffcfc">
                                        <div class="box">
                                            
                                            @if($row->status_show == "0")
                                            {{-- @if($row->model_path == null) --}}
                                                <div >
                                                    <img src="{{url($row->image)}}"  width="100%" height="150px">
                                                </div>
                                            @else
                                                <div class="productinfo text-center" style="background: #17C2A6; border-radius: 5px;">
                                                    <model-viewer src="{{url($row->model_path) }}" alt="model robot" auto-rotate camera-controls ar  width="400px" height="300px"></model-viewer>
                                                </div>
                                            @endif

                                            <div class="card-body">
                                                <strong style="font-size: 20px"><a href="{{url('/asset/detail/'.$row->id)}}" class="dropdown-item"> {{ $row->display_name }}</a></strong>
                                                <div class="d-flex justify-content-between my-2">
                                                    <div class=" flex-row-reverse">
                                                        <a href="{{url('/search/category/'.$row->category_id)}}" type="button" class="btn btn-outline-primary">{{ $row->category->name_th }}</a>
                                                        <a href="{{url('/search/typefile/'.$row->typefile_id)}}" type="button" class="btn btn-outline-primary">{{ $row->typefile->name }}</a>                                                        
                                                        <a href="{{url('/search/formats/'.$row->formats)}}" type="button" class="btn btn-outline-primary">{{ $row->typefile->formats }}</a>
                                                    </div>
                                                    <div class="d-flex flex-row-reverse">
                                                        <div class="flex-row-reverse">
                                                            <a href="{{url('/search/category/'.$row->category_id)}}" type="button" class="btn btn-outline-success"> 
                                                                {{number_format( $row->download->count())}} <i class="fas fa-download"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div style="font-size:18px" class="my-2">
                                                    ราคา:<strong style="color:#0eaf94; font-size: 18px">                             
                                                        @if ($row->price == 0)
                                                            ฟรี
                                                        @else
                                                            {{ number_format( $row->price )}} บาท
                                                        @endif
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @elseif($asset->count() == 0)
                            <h3 class="text text-center" style="color:red">-- ไม่มีข้อมูลค้นหาที่ใกล้เคียง --</h3>
                        @endif
                       
                    </div>
                 
                    <div class="pagination-block my-2" style="float:right">
                        {{ $asset->appends(request()->input())->links('layouts.paginationlinks') }}
                    </div>
                  
                </div>
            </section>

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
