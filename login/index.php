<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Portal GACF | Inicio de Sesion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/gacf-web-mexico/assets/images/favicon.ico">
    <!-- Theme Config Js -->
    <script src="/gacf-web-mexico/assets/js/config.js"></script>
    <!-- App css -->
    <link href="/gacf-web-mexico/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="/gacf-web-mexico/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <script src="/gacf-web-mexico/assets/js/jquery/jquery-3.5.1.min.js"></script>
    <script src="/gacf-web-mexico/login/js/login.js"></script>
</head>

<body class="authentication-bg position-relative">

    <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1920 1024">
            <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                <rect width="1920" height="1024" x="0" y="0" fill="url(#SvgjsLinearGradient1047)"></rect>
                <path d="M1920 0L1864.16 0L1920 132.5z" fill="rgba(255, 255, 255, .1)"></path>
                <path d="M1864.16 0L1920 132.5L1920 298.4L1038.6100000000001 0z" fill="rgba(255, 255, 255, .075)"></path>
                <path d="M1038.6100000000001 0L1920 298.4L1920 379.53999999999996L857.7000000000002 0z" fill="rgba(255, 255, 255, .05)"></path>
                <path d="M857.7 0L1920 379.53999999999996L1920 678.01L514.57 0z" fill="rgba(255, 255, 255, .025)"></path>
                <path d="M0 1024L939.18 1024L0 780.91z" fill="rgba(0, 0, 0, .1)"></path>
                <path d="M0 780.91L939.18 1024L1259.96 1024L0 585.71z" fill="rgba(0, 0, 0, .075)"></path>
                <path d="M0 585.71L1259.96 1024L1426.79 1024L0 408.19000000000005z" fill="rgba(0, 0, 0, .05)"></path>
                <path d="M0 408.19000000000005L1426.79 1024L1519.6599999999999 1024L0 404.09000000000003z" fill="rgba(0, 0, 0, .025)"></path>
            </g>
            <defs>
                <mask id="SvgjsMask1046">
                    <rect width="1920" height="1024" fill="#ffffff"></rect>
                </mask>
                <linearGradient x1="11.67%" y1="-21.87%" x2="88.33%" y2="121.88%" gradientUnits="userSpaceOnUse" id="SvgjsLinearGradient1047">
                    <stop stop-color="#0e2a47" offset="0"></stop>
                    <stop stop-color="#00459e" offset="1"></stop>
                </linearGradient>
            </defs>
        </svg>
    </div>

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card ">

                        <!-- Logo -->
                        <div class="card-header pt-4 text-center">
                            <div class="auth-brand mb-0">
                                <a href="index.html" class="logo-dark">
                                    <span><img src="/gacf-web-mexico/assets/images/login_logo.png" alt="dark logo" height="28"></span>
                                </a>
                                <a href="index.html" class="logo-light">
                                    <span><img src="/gacf-web-mexico/assets/images/login_logo_v2.png" alt="logo" height="28"></span>
                                </a>
                            </div>                            
                            <p class="text-muted mb-1">Portal de Gestión Administrativa, Contable y Financiera.</p>
                        </div>

                        <div class="card-body">

                            <div class="text-center w-75 m-auto">
                                <img src="/gacf-web-mexico/assets/images/users/avatar-0.png" alt="image" class="rounded-circle avatar-md img-thumbnail">
                                <!-- <div class="spinner-load"></div> -->
                           </div>
                               
                            <div class="text-center w-75 m-auto"> 
                                <br><h4 class="text-dark-50 text-center pb-0">Iniciar Sesión</h4>
                            </div>

                            <form action="#">

                                <div class="mb-3">
                                    <label for="Idusername" class="form-label">Usuario</label>
                                    <input class="form-control" type="text" id="Idusername-signin" name="Idusername-signin" required="" placeholder="Ingresar clave de usuario">
                                </div>

                                <div class="mb-3">
                                    <a href="recuperar-pwd" class="text-muted float-end fs-12"> ¿Olvidó su Contraseña?</a>
                                    <label for="Idpassword" class="form-label">Contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="Idpassword-signin" name="Idpassword-signin"  required="" placeholder="Ingresar contraseña">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="form-checkbox-info">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" name="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Recordarme</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-info" type="submit" id="btn-signin"> Iniciar </button>
                                </div>
<!-- 
                                  -->

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <!-- <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Don't have an account? <a href="#" class="text-white ms-1 link-offset-3 text-decoration-underline"><b>Sign Up</b></a></p>
                        </div> 
                    </div> -->
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        <span class="text-white-50">
            <script>
                document.write(new Date().getFullYear())
            </script> © Grupo Planeta
        </span>
    </footer>

    <!-- Vendor js -->
    <script src="/gacf-web-mexico/assets/js/vendor.min.js"></script>
    <!-- App js -->
    <script src="/gacf-web-mexico/assets/js/app.min.js"></script>

</body>

</html>