@extends('layouts.index')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <section >
                <div class="container-fluid px-4">
                {{-- <div class="container" data-aos="fade-up"> --}}
                    <div class="row my-4">

                        @foreach( $asset as $row) 
                        <div class="col-lg-3 col-md-2" data-aos="fade-up"  >
                            <div class="card" style="border-radius: 25px; background: #fafafa">
                                <div class="box">
                                    
                                    @if($row->status_show == 0)
                                        <div >
                                            <img src="{{url($row->image)}}"  width="100%" height="150px">
                                        </div>
                                    @else
                                        <div class="productinfo text-center" style="background: #17C2A6; border-radius: 5px;">
                                            <model-viewer src="{{ $row->model_path }}" alt="model robot" auto-rotate camera-controls ar  width="400px" height="300px"></model-viewer>
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <strong style="font-size: 20px">{{ $row->display_name }}</strong><br>
                                        <div class="d-flex justify-content-between">
                                            <div class=" flex-row-reverse  ">
                                                <a type="button" class="btn btn-outline-info">{{ $row->typefile->name }}</a>
                                            </div>
                                            <div class="d-flex flex-row-reverse  ">
                                        
                                                <div class=" flex-row-reverse  ">
                                                    <a type="button" class="btn btn-outline-info">{{ $row->category->name_th }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <strong style="font-size:18px">
                                            ราคา:<strong style="color:#17C2A6; font-size: 18px">
                                                @if ($row->price == 0)
                                                    ฟรี
                                                @else
                                                    {{ number_format( $row->price )}}
                                                @endif
                                            </strong>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                    </div>
                    <div class="pagination-block">
                        {{  $asset->appends(request()->input())->links('layouts.paginationlinks') }}
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
