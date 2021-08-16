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
                            <div class="card" style="border-radius: 10px; background: #fafafa">
                                <div class="box">
                                    <div class="productinfo text-center" style="background: #17C2A6">
                                        <model-viewer src="{{ asset('models/crocodile/scene.gltf') }}" alt="model robot" auto-rotate camera-controls ar  width="400px" height="250px"></model-viewer>

                                        {{-- <img src="{{asset("images/".$row->image) }}" style="border-radius: 25px;" alt="" width="400px" height="250px"/> --}}
                                    </div>
                                    <div class="card-body">
                                        <strong style="font-size: 30px">{{ $row->display_name }}</strong><br>
                                        <div class="d-flex justify-content-between">
                                            <div class=" flex-row-reverse  ">
                                                
                                                <h6 style="border-radius: 10px;border: 2px solid #17C2A6;width: 160px; padding: 0.1cm 0.1cm 0.1cm 0.1cm">
                                                    <center>นามสกุลไฟล์: {{ $row->typefile->name }}</center> 
                                                </h6>
                                            </div>
                                            <div class="d-flex flex-row-reverse  ">
                                                <h6 style="border-radius: 10px;border: 2px solid #17C2A6;width: 186px; padding: 0.1cm 0.1cm 0.1cm 0.1cm">
                                                    <center>หมวดหมู่:  {{ $row->category->name_th }}</center> 
                                                </h6>
                                            </div>
                                        </div>
                                        
                                        <h3>ราคา:<strong style="color:#17C2A6; font-size: 30px"> {{ number_format( $row->price )}}</strong></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
