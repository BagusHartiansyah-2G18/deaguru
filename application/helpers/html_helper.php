<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    // print data for array
    function _log($msg){
        echo "<pre>";
        print_r($msg);
    }
    function _css(){
        $CI =& get_instance();
        $url=base_url()."/assets/thema/creativeStudio";
        return'
            <link rel="stylesheet" href="'.$url.'/assets/vendors/themify-icons/css/themify-icons.css">
            <link rel="stylesheet" href="'.$url.'/assets/css/creative-studio.css">
        ';
    }
    function _navBar($ind){
        $CI =& get_instance();
        $assets=base_url()."/assets/thema/creativeStudio/";
        $router=base_url()."control/";
        return '
            <nav class="navbar custom-navbar navbar-expand-lg navbar-dark" data-spy="affix" data-offset-top="20">
                <div class="container">
                    <a class="navbar-brand" href="#" onclick="_login()">
                        <img src="'.base_url().'assets/fs_css/logo/dea.png" style="width: 110px;" alt="_Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="'.($ind==1?'#beranda':$router).'">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="'.($ind==2?'#pendidikan':$router.'pendidikan').'">Pendidikan & Pelatihan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="'.($ind==3?'#pengembangan':$router.'pengembangan').'">Pengembangan Masyarakat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="'.($ind==4?'#riset':$router.'riset').'">Riset & Inovasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">Tentang Kami</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        ';
    }
    function _header($v){
        $CI =& get_instance();
        return '
        <header id="'.$v['id'].'" class="header" style="background-image:url(\''.base_url().'/assets/fs_css/'.$v['bg'].'\')">
            <div class="overlay ">
                '.$v['html'].'
            </div>      
        </header>
        ';
    }
    function _program(){
        return '
            <div class="box text-center" style="max-width: 1250px;max-height: 400px;">
                <div class="box-item">
                    <i class="ti-world"></i>
                    <h6 class="box-title">Penelitian</h6>
                    <p>
                        <ul class="text-left p-2">
                            <li>Analisis kebijakan</li>
                            <li>Survey Pasar dan Kepuasan Konsumen</li>
                            <li>Pemetaan Potensi Daerah</li>
                            <li>Pelatihan dan Pengembangan Masyarakat</li>
                        </ul>
                    </p>
                </div>
                <div class="box-item">
                    <i class="ti-bar-chart"></i>
                    <h6 class="box-title">Monitoring dan evaluasi</h6>
                    <p>
                        <ul class="text-left p-2">
                            <li>Perencanaan dan rancang bangun program</li>
                            <li>Pemantauan sosial</li>
                            <li>Evaluasi kebijakan</li>
                        </ul>
                    </p>
                </div>


                <div class="box-item">
                    <i class="ti-dropbox-alt"></i>
                    <h6 class="box-title">Pengembangan kapasitas / pelatihan</h6>
                    <p>
                        <ul class="text-left p-2">
                            <li>Teknik pengumpulan dan analisis data</li>
                            <li>Penulisan laporan, rekomendasi kebijakan, dan catatan kebijakan</li>
                            <li>Metodologi penelitian</li>
                        </ul>
                    </p>
                </div>
                <div class="box-item">
                    <i class="ti-mobile"></i>
                    <h6 class="box-title">Komunikasi kebijakan</h6>
                    <p>
                        <ul class="text-left p-2">
                            <li>Dialog publik/diskusi publik</li>
                            <li>Diseminasi hasil penelitian</li>
                        </ul>
                    </p>
                </div>
            </div>
        ';
    }
    function _listdeaguru(){
        return '
            <section class="has-bg-img py-md">
                <div class="container-fluid text-center">
                    <h6 class="section-title mb-6">NILAI UTAMA KAMI</h6>
                    <div class="widget mb-4">
                        <div class="widget-item ">
                            <i class="ti-medall"></i>
                            <h4>Profesional</h4>
                        </div>
                        <div class="widget-item">
                            <i class="ti-lock"></i>
                            <h4>Independen</h4>
                        </div>
                        <div class="widget-item">
                            <i class="ti-widget-alt"></i>
                            <h4>Objektif</h4>
                        </div>
                        <div class="widget-item">
                            <i class=" ti-star"></i>
                            <h4>Inklusif</h4>
                        </div>
                        <div class="widget-item">
                            <i class=" ti-bar-chart"></i>
                            <h4>Inovatif</h4>
                        </div>
                    </div>
                </div>
            </section>
        ';
    }
    function _infoDea($v){
        $CI =& get_instance();
        return '
            <section>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5 col-lg-4">
                            <img src="'.base_url().'assets/fs_css/bg.jpg" alt="Dea Guru" class="w-100 shadow img-thumbnail mb-3">
                        </div>
                        <div class="col-md-7 col-lg-8">
                            <h6 class="section-title mb-3">'.$v[0]['isi'].'</h6>
                            <p>'.$v[2]['isi'].'</p>
                            <p>'.$v[3]['isi'].'</p>
                        </div>
                    </div>
                </div>
            </section>
        ';
    }
    function _tentangKami($v){
        return '
            <section>
                <div class="container">
                    <div class="contact-card">
                        <div class="infos"> 
                            <h6 class="section-title mb-4">Tentang Kami</h6>

                            <div class="item">
                                <div class="">
                                    <p>'.$v[4]['isi'].'</p>
                                </div>                          
                            </div>
                            <div class="item">
                                <div class="">
                                    <p>'.$v[5]['isi'].'</p>
                                </div>                          
                            </div>

                            <div class="item">
                                <div class="">
                                    <p>'.$v[6]['isi'].'</p>
                                </div>                          
                            </div>
                            <div class="item">
                                <div class="">
                                    <p>'.$v[7]['isi'].'</p>
                                </div>                          
                            </div>


                            <div class="item">
                                <div class="">
                                    <p>'.$v[8]['isi'].'</p>
                                </div>                          
                            </div>

                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="contact-card">
                        <div class="infos"> 
                            <h6 class="section-title mb-4">Contact Us</h6>

                            <div class="item">
                                <i class="ti-location-pin text-info"></i>
                                <div class="">
                                    <h5>'.$v[9]['nama'].'</h5>
                                    <p>'.$v[9]['isi'].'</p>
                                </div>                          
                            </div>
                            <div class="item">
                                <i class="ti-mobile text-info"></i>
                                <div>
                                    <h5>'.$v[10]['nama'].'</h5>
                                    <p>'.$v[10]['isi'].'</p>
                                </div>                          
                            </div>
                            <div class="item">
                                <i class="ti-email text-info"></i>
                                <div class="mb-0">
                                    <h5>'.$v[11]['nama'].'</h5>
                                    <p>'.$v[11]['isi'].'</p>
                                </div>
                            </div>
                            <div class="item">
                                <i class="ti-facebook text-info"></i>
                                <div class="mb-0">
                                    <h5>'.$v[12]['nama'].'</h5>
                                    <p>'.$v[12]['isi'].'</p>
                                </div>
                            </div>
                        </div>
                        <div class="form">
                            <h6 class="section-subtitle mb-4">Memulai komunikasi dengan kami via email</h6>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <textarea id="pesan" cols="30" rows="7" class="form-control form-control-lg" placeholder="Message"></textarea>
                                </div>
                                <button onclick="_sendKomunikasi()" class="btn btn-info btn-block btn-lg mt-3">Send Message</button>
                        </div>
                    </div>
                </div>
            </section>
        ';
    }
    function _foother($v){
        return '
            <section id="about" class="has-bg-img py-0 container-fluid">
                <div class="container">
                    <div class="footer">
                        <div class="footer-lists">
                            <ul class="list">
                                <li class="list-head">
                                    <h6 class="font-weight-bold">Tentang Kami</h6>
                                </li>
                                <li class="list-body">
                                    <a href="#" class="logo bg-light">
                                        <img src="'.base_url().'assets/fs_css/logo/dea.png" style="width: 110px;" alt="_Logo">
                                    </a>
                                    <p>'.$v[2]['isi'].'</p> 
                                    <p class="mt-3">
                                        Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a class="d-inline text-info">'.$v[0]['isi'].'</a>
                                    </p>                   
                                </li>
                            </ul>
                            <ul class="list">
                                <li class="list-head">
                                    <h6 class="font-weight-bold">Blog</h6>
                                </li>
                                <li class="list-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="">Pendidikan & Pelatihan</a>
                                            <a href="">Pengembangan Masyarakat</a>
                                            <a href="">Riset & Inovasi</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list">
                                <li class="list-head">
                                    <h6 class="font-weight-bold">Kontak</h6>
                                </li>
                                <li class="list-body">
                                    <p><i class="ti-location-pin"></i> '.$v[9]['isi'].'</p>
                                    <p><i class="ti-email"></i> '.$v[11]['isi'].'</p>
                                    <p><i class="ti-mobile"></i> '.$v[10]['isi'].'</p>
                                    <p><i class="ti-facebook"></i> '.$v[12]['isi'].'</p>
                                </li>
                            </ul>
                        </div>
                    </div>    
                </div>
            </section>
        ';
    }
    function _js($nmFolder){
        $assets=base_url()."/assets/thema/creativeStudio/";
        $assetsMfc=base_url()."/assets/JsMaster/";
        return '
            <script src="'.$assets.'assets/vendors/jquery/jquery-3.4.1.js"></script>
            <script src="'.$assets.'assets/vendors/bootstrap/bootstrap.bundle.js"></script>
        
            <!-- bootstrap affix -->
            <script src="'.$assets.'assets/vendors/bootstrap/bootstrap.affix.js"></script>
        
            <!-- Creative Studio js -->
            <script src="'.$assets.'assets/js/creative-studio.js"></script>
            
            <script src="'.$assetsMfc.'M-DATA.js"></script>
            <script src="'.$assetsMfc.'M-HTML-FORM.js"></script>
            <script src="'.$assetsMfc.'M-HTML.js"></script>
            <script src="'.$assetsMfc.'M.js"></script>
            <script src="'.$assetsMfc.'v.js"></script>
            <script src="'.$assetsMfc.$nmFolder.'/index.js"></script>

        ';
    }
    function _modal(){
        return '
            <div class="modal fade" id="modalEx1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div role="alert" id="alert" class="alert alert-primary alert-dismissible fade">
                    <p id="msg"></p>
                </div>
                <div class="modal-content">
                    <div class="modal-header ">
                    <div id="modalH1">
                        bagus H
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body " id="modalB1">
                    </div>
                    <div class="modal-footer" id="modalF1">
                    
                    </div>
                </div>
                </div>
            </div>
        ';
    }
    function _html($v){
        return '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta name="description" content="Start your development with Creative Studio landing page.">
                <meta name="author" content="Devcrud">
                <title>DeaGuru Institute</title>
                <link href="'.base_url().'/assets/fs_css/logo/dea.png" rel="icon">
               '._css().'
            </head>
            <body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
                '._navBar($v['ind'])
                .$v['html']
                ._foother($v['publik'])
                ._js($v['nmFolder'])
                ._modal().'
            </body>
            </html>
        ';
    }
    function _branda($v){
        return _header([
            "id"=>'beranda',
            "bg"=>"bg1.webp",
            "html"=>'
                <h1 class="title ">“'.$v[0]['isi'].'”</h1>
                <h6 class="subtitle text-dark text-center" style="max-width:550px; font-size:23px">
                    '.$v[1]['isi'].'
                </h6>
            '
        ])
        ._program()
        ._infoDea($v)
        ._listdeaguru($v)
        ._tentangKami($v);
    }
    function _pendidikan($v){
        return _header([
            "id"=>'pendidikan',
            "bg"=>"bg1.webp",
            "html"=>'
                <h1 class="p-2">“ '.$v[13]['nama'].' ”</h1>
                <h6 class="subtitle text-dark text-center" style="max-width:550px; font-size:23px">
                    '.$v[13]['isi'].'
                </h6>'
        ])
        ._formPencarian();
    }
    function _pengembangan($v){
        return _header([
            "id"=>'pengembangan',
            "bg"=>"bg1.webp",
            "html"=>'
                <h1 class="p-2">“ '.$v[14]['nama'].' ”</h1>
                <h6 class="subtitle text-dark text-center" style="max-width:550px; font-size:23px">
                    '.$v[14]['isi'].'
                </h6>'
        ])
        ._formPencarian();
    }
    function _riset($v){
        return _header([
            "id"=>'riset',
            "bg"=>"bg1.webp",
            "html"=>'
                <h1 class="p-2">“ '.$v[15]['nama'].' ”</h1>
                <h6 class="subtitle text-dark text-center" style="max-width:550px; font-size:23px">
                    '.$v[15]['isi'].'
                </h6>'
        ])
        ._formPencarian();
    }
    function _formPencarian(){
        return '
            <div class="box p-3 d-lg-flex flex-column align-items-start" style="max-height: 400px;">
                <div class="p-2">
                    Form Pencarian
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search" placeholder="judul blog" value="" onchange="searchData(this)">
                    <button class="input-group-text bg-info" onclick="btnSearch()">search</button>
                </div>
            </div>
            <section id="blog" class="container justify-content-center">
            </section>
        ';
    }

    function _blog($v){
        $file=explode("/",$v['files']);
        $xfile=$file[0];
        return _header([
            "id"=>$v['thema'],
            "bg"=>"bg1.webp",
            "html"=>'' 
        ])
        .'
        <div class="box p-3 d-lg-flex flex-column align-items-start" style="max-height:1100px; margin-top:-450px; margin-bottom:100px;background: none;box-shadow:none;">
            <div class="card blog-post my-4 my-sm-5 my-md-0 shadow">
                <img src="'.base_url().'/assets/fs_sistem/upload/blog/'.$xfile.'" alt="">
                <div class="card-body">
                    <h3 class="card-title text-center">'.$v['judul'].'</h3> 
                    <h6 class="subtitle text-dark" style="max-width:850px; font-size:23px">
                        '.$v['isi'].'
                    </h6>  
                </div>
            </div>
        </div>
        ';
    }
?>