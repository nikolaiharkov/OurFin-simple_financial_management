<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>OurFin - Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
      body {
        background-image: url("bg.png");
        background-repeat: no-repeat;
        background-size: 100% 100%;
      }
      @media screen and (max-width: 767px) {
  body {
    background-image: url("bg.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }
}

@media screen and (min-width: 768px) {
  body {
    background-image: url("bg.png");
    background-repeat: no-repeat;
    background-size: 100% 150%;
    background-position: center;
  }
}
    </style>
    </head>
    <!-- put a background with image bg.png -->
    <body>
        <!-- put a background with image bg.png -->
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">OurFin Login</h3></div>
                                    <div class="card-body">
                                        <form action="engine/proseslogin.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" placeholder="username" name="username" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Create with ❤ by HarkovNet</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
