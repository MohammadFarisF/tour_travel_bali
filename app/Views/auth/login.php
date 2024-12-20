<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Explore Tour and Travel</title>
    <link href="<?= base_url() ?>asset_admin/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>asset_user/img/title.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-auth">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="fw-light my-4">Login</h3>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#userInfoModal">User Info</button>
                                </div>
                                <div class="card-body">
                                    <?php if (session()->getFlashdata('danger')) : ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('danger') ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Login form-->
                                    <form action="<?= base_url() ?>login/proses" method="post">
                                        <!-- Form Group (email address / username) -->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control" id="inputEmail" name="email" type="email" placeholder="Enter email address" required />
                                        </div>
                                        <!-- Form Group (password) -->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Enter password" required />
                                        </div>
                                        <!-- Form Group (login box) -->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="<?= base_url() ?>register">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-dark">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; Explore Tour and Travel 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- User Info Modal -->
    <div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userInfoModalLabel">User Account Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>SUPERADMIN</h6>
                    <p>Username: teguhpratama@gmail.com</p>
                    <p>Password: teguh123</p>
                    <hr>
                    <h6>ADMIN</h6>
                    <p>Username: jakajayanto @mail.com</p>
                    <p>Password: Jaka123</p>
                    <hr>
                    <h6>CUSTOMER</h6>
                    <p>Username: agushariyanto@gmail.com</p>
                    <p>Password: agus123</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>asset_admin/js/scripts.js"></script>
</body>

</html>