<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Store 2D&3D</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('css/layouts/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="{{ asset('js/sweetalert_delete.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/layouts/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('js/layouts/datatables-simple-demo.js') }}"></script>
        
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">

        {{-- 3D --}}
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link rel="stylesheet" href="{{ asset('css/layouts/style _showmodel.css') }}">
        <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
        <script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>

        <script type="text/javascript"> 
            $(function(){
                 //Sliding effect just replace fadeOut() to slideUp()
                $('.slideUp_table').click(function()
                {
                    $('#form_data').slideUp("slow");
                });

                //Sliding effect just replace fadeIn() to slideDown()
                $('.slideDown_table').click(function()
                {
                    $('#form_data').slideDown("slow");
                });

                //Sliding effect just replace fadeIn() to slideToggle()
                $('.slideToggle_table').click(function()
                {
                    $('#form_data').slideToggle("slow");
                    
                });
            })

            // $(document).ready(function() {
            //     $('#select-tags').select2();
            //     $('.js-example-basic-multiple').select2();
            // });

        </script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            
            <a class="navbar-brand ps-3" href="/">STORE 2D & 3D</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="{{url('/')}}" method="get">
                <div class="input-group">
                    <input class="form-control" type="text" type="search" name="search" placeholder="ค้นหา ชิ้นงาน..." aria-label="Search for..." aria-describedby="btnNavbarSearch"  />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
                
            </form>
            @guest
             
            @else
                <form class="navbar-nav ml-auto ms-md-0 me-3 me-lg-4">
                    <a href="{{url('/asset/upload')}}" style="color: white">
                        <i class="fas fa-upload"></i>
                    </a>
                </form>
            @endguest

            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ms-md-0 me-3 me-lg-4">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-success" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        @if(Auth::user()->image != 0)
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                                <img src="{{url(Auth::user()->image)}}" style="border-radius: 50%; width: 30px; height: 30px" >
                            </a>
                        @else
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                                <i class="fas fa-user fa-fw"></i>
                            </a>
                        @endif
                       
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> 
                                <span class="dropdown-item">
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                </span>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="{{url('/asset/dashboard/'.Auth::user()->id)}}">ชิ้นงานของฉัน</a></li>
                            <li><a class="dropdown-item" href="{{url('/users/edit/'.Auth::user()->id)}}">บัญชีของฉัน</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    {{ __('ออกจากระบบ') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            @if(Auth::check() != null )
                                @if(Auth::user()->checkIsStatus() && Auth::check() && (Auth::user()->checkIsStatus() != 0 ) || (Auth::user()->id == 1 ))
                                    <div class="sb-sidenav-menu-heading">Admin Panel</div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                                        ข้อมูลในระบบทั้งหมด
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{url('/asset/dashboard')}}"><i class="fas fa-cube"></i> &nbsp; ชิ้นงานในระบบ</a>
                                            <a class="nav-link" href="{{url('/users')}}"><i class="fas fa-users"></i> &nbsp; ผู้ใช้งาน</a>
                                            <a class="nav-link" href="{{url('/category')}}"><i class="fas fa-poll-h"></i> &nbsp; หมวดหมู่</a>
                                            <a class="nav-link" href="{{url('/typefile')}}"><i class="far fa-file-image"></i> &nbsp; ประเภทไฟล์</a>
                                            <a class="nav-link" href="{{url('/license')}}"><i class="fas fa-file-signature"></i> &nbsp;ประเภทเผยเเพร่</a>
                                        </nav>
                                    </div>
                                    <div class="sb-sidenav-menu-heading"> </div>
                                @endif     
                            @endif


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#typefile" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cube"></i> </div>
                                    รูปแบบ
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="typefile" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @foreach( $formats as $format ) 
                                        <a class="nav-link" href="{{url('/search/formats/'.$format->formats)}} ">{{ $format->formats }}</a>
                                    @endforeach
                                </nav>
                            </div> 


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-poll-h"></i> </div>
                                    หมวดหมู่
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @foreach( $categories as $category ) 
                                        @if($category->asset->count() >= 1 )
                                            <a class="nav-link" href="{{url('/search/category/'.$category->id)}} ">{{ $category->name_th }}</a>
                                        @endif
                                    @endforeach
                                </nav>
                            </div>
                            

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#format" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="far fa-file-image"></i> </div>
                                    ประเภทไฟล์
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="format" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @foreach( $typefiles as $typefile ) 
                                        @if($typefile->asset->count() >= 1 )
                                            <a class="nav-link" href="{{url('/search/typefile/'.$typefile->id)}} "> {{ $typefile->name }}</a>
                                        @endif
                                    @endforeach
                                </nav>
                            </div>
                          
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        {{-- <div class="small">Logged in as:</div> --}}
                        Copyright &copy; BUU 
                        Informatics 2021
                    </div>
                </nav>

            </div>
