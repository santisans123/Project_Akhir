<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>Aquaculture Pens</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{asset('style/assets/favicon.ico')}}" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('style/css/styles.css')}}" rel="stylesheet" />
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:blue){.blue\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.blue\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.blue\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.blue\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.blue\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Aquaculture</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="#contact">Hubungi kami</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Buku Panduan</a></li>        
                    </ul>
                </div>

                @if(Route::has('login'))
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{url('datatambak')}}">Darsboard</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Log in</a></li>

                        @endauth   
                    </ul>
                </div>
                @endif

                
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Totally Integrated Smart Aquaculture System for Indonesia</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Sebuah platform digital yang dibangun dengan tujuan untuk mendukung penguatan sektor budidaya perairan (akuakultur) Indonesia yang maju dan mandiri.</p>
                        {{-- <a class="btn btn-light btn-xl" href="#contact">Gabung</a> --}}
                        <a class="btn btn-info btn-xl" href="#about">Baca Lainnya</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Tentang kami</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">TISASforINA adalah sebuah platform digital yang 
                            dibangun dengan tujuan untuk mendukung penguatan sektor budidaya perairan 
                            (akuakultur) Indonesia yang maju dan mandiri. Platform ini dibangun oleh tim Riset 
                            Grup Aquaculture Engineering Applied Technology (ACE App-Tech) Politeknik 
                            Elektronika Negeri Surabaya dan didanai oleh Lembaga Pengelolaan Dana Pendidikan 
                            (LPDP) yang dikelola oleh Direktorat Jenderal Pendidikan Vokasi Kementerian 
                            Pendidikan dan Kebudayaan, Riset dan Teknologi, Republik Indonesia.</p>
                    </div>
                </div>
                <div class="container px-4 px-lg-5 text-white" >
                    <div class="row" style="margin-top:1rem ">
                        <div class="col-sm text-center mx-2 my-2 pt-3 border border-light rounded" >
                            <h4 class="h5 my-4">Visi</h4>
                            <p>Mewujudkan sektor budidaya air untuk ketahanan pangan Indonesia yang mandiri, maju dan kuat berdasarkan keadilan dan beradab. </p>
                            {{-- <a class="btn btn-outline-light text-white my-4" style="background-color:transparent" href="">Read more</a> --}}
                        </div>


                        <div class="col-sm text-center mx-2 my-2 pt-3 border border-light rounded" >
                            <h4 class="h5 my-4">Misi</h4>
                            <p>Mempertemukan dan mengkolaborasikan pengusaha, peneliti, pengajar, komunitas dan pemerintah untuk memiliki persamaan persepsi mengembangkan akuakultur Indonesia melalui penelitian, inovasi dan penerapan teknologi.</p>
                            {{-- <a class="btn btn-outline-light text-white my-4" style="background-color:transparent" href="">Read more</a> --}}
                        </div>
                        <div class="col-sm text-center mx-2 my-2 pt-3 border border-light rounded" >
                             <h4 class="h5 my-4">Deskripsi</h4>
                            <p>TISASforINA  merupakan singkatan dari Totally Integrated Smart Aquaculture System for Indonesia</p>
                            <p>TISASforINA adalah sebuah platform online yang menjadi tempat bertemu pengusaha, peneliti, pengajar, komunitas akuakultur (budidaya air) serta pemerintah untuk mempromosikan potensi akuakultur Indonesia.</p>
                            {{-- <a class="btn btn-outline-light text-white my-4" style="background-color:transparent" href="">Read more</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Layanan Kami</h2>
                <hr class="divider" />
                <div class="row ">
                    <div class="col-sm text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Memonitor Tambak</h3>
                            <p class="text-muted mb-0">Dengan bergabung di TISASforINA, anda bisa melihat, memantau kondisi kolam anda, bisa melihat sejarah dari proses budidaya, memudahkan anda untuk melihat data kolam anda yang sekarang atau yang lampau.</p>
                        </div>
                    </div>
                    <div class="col-sm text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Kontirbusi pada Aquakultur</h3>
                            <p class="text-muted mb-0">Dengan bergabung di TISASforINA, anda telah memberikan kontribusi untuk meningkatkan penelitian dibidang akuakultur, membangun akuakultur Indonesia yang maju, kuat dan mandiri.</p>
                        </div>
                    </div>
                    <div class="col-sm text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Sebagai Inovasi Bangsa</h3>
                            <p class="text-muted mb-0">Dengan bergabung di TISASforINA, anda telah memberikan kontribusi untuk meningkatkan inovasi nasional dibidang akuakultur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to action-->
        <section class="page-section bg-primary text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Ayo gabung dengan kami</h2>
                <p class="text-white-75 mb-4">hubungi kontak kami untuk join.</p>
                {{-- <a class="btn btn-light btn-xl" href="#contact">gabung</a> --}}
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Hubungi kami</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Kirim pesan anda</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">Isi dengan nama anda.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">isi dengan Email anda.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email salah.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Nomor Hp</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">Isi dengan nomor hp anda.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Pesan</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">Isi dengan pesan anda.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="/">Berhasil</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container" >
                <h4 class="d-flex justify-content-center font-bold" style="margin-top: 7rem"> Featured Sponsors</h4>
                <div class="row justify-content-center">
                    <div class="col-lg-4 mt-4 text-center mb-2 mb-lg-0">
                        <img src="{{asset('style/assets/pens.png')}}" alt="" style="max-width: 20%; opacity: 0.6; ">
                    </div>
                    <div class="col-lg-4 mt-4 text-center mb-2 mb-lg-0">
                        <img src="{{asset('style/assets/aqua.png')}}" alt="" style="max-width: 20%; opacity: 0.6">
                    </div>
                </div>
            </div>
            
        </section>
        <!-- Footer-->
        <footer class="bg-light py-4">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2022 - Aquaculture</div></div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('style/js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>


