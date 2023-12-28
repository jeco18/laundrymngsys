<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="shortcut icon" href="assets/img/washing-clothes.gif" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">

</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column bg" id="content-wrapper">
            <div id="content">
                <section class="position-relative py-4 py-xl-5">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                                <h2 class="display-4 fw-bold">Welcome Back!</h2>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-5">
                                    <div class="card-body d-flex flex-column align-items-center">
                                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/washing-clothes.gif" width="80" height="80"></div>
                                        <form class="form-control border border-0" action="functions/login.php" method="post">
                                            <div class="mb-3"><input class="form-control" type="text" name="username" placeholder="Username"></div>
                                            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                                            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Login</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ecodev&nbsp;2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/listTable.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type');
        const message = urlParams.get('message');
        if (type == 'success') {
            swal("Success!", message, "success");
        } else if (type == 'error') {
            swal("Error!", message, "error");
        }
        
    </script>
</body>

</html>