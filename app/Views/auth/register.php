<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - Explore Tour and Travel</title>
    <link href="<?= base_url() ?>asset_admin/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>asset_user/img/title.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <!-- Basic registration form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <?php if (session()->getFlashdata('validation')): ?>
                                        <div class="alert alert-danger">
                                            <?php foreach (session()->getFlashdata('validation') as $error): ?>
                                                <p><?= esc($error) ?></p>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (session()->getFlashdata('success')): ?>
                                        <div class="alert alert-success">
                                            <?= session()->getFlashdata('success'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Registration form-->
                                    <form action="<?= base_url('register/proses') ?>" method="post">
                                        <!-- Form Row-->


                                        <!-- Form Group (first name)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputFullName">Full Name</label>
                                            <input class="form-control" id="inputFullName" name="fullname" type="text" placeholder="Enter full name" />
                                        </div>


                                        <!-- Form Group (last name)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputLastName">Phone Number</label>
                                            <input class="form-control" id="inputLastName" name="no_hp" type="number" placeholder="Enter phone number" />
                                        </div>


                                        <!-- Form Group (email address)            -->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                        </div>
                                        <!-- Form Row    -->
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <!-- Form Group (password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputPassword">Password</label>
                                                    <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Enter password" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (confirm password)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                    <input class="form-control" id="inputConfirmPassword" name="confirm_password" type="password" placeholder="Confirm password" />
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <button type="submit" class="btn btn-primary">Create Account</button>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="<?= base_url() ?>login">Have an account? Go to login</a></div>
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
    <script src="<?= base_url() ?>https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>js/scripts.js"></script>
</body>

</html>