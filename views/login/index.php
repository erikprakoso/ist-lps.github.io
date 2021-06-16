<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/app.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <!-- <a href="index.html"><img src="<?= base_url('assets/'); ?>images/logo/logo.png" alt="Logo"></a> -->
                        <h3>POC LPS</h3>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                    <?php if ($this->session->flashdata('info')) : ?>
                        <div class="alert alert-primary" role="alert">
                            <?php echo $this->session->flashdata('info'); ?>
                        </div>
                    <?php elseif ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('login'); ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <select class="form-select" aria-label="Default select example" id="userEmail" name="userEmail" onchange="showDiv(this)">
                                <option value="1">Username</option>
                                <option value="2">Email</option>
                            </select>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4" id="username">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="inputUsername" id="inputUsername">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <?= form_error('inputUsername', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4" style="display:none" id="email">
                            <input type="text" class="form-control form-control-xl" placeholder="Email" name="inputEmail" id="inputEmail">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <?= form_error('inputEmail', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="inputPassword" id="inputPassword">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <?= form_error('inputPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <!-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="<?= base_url('register'); ?>" class="font-bold">Sign
                                up</a>.</p>
                        <!-- <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        function showDiv(select) {
            if (select.value == 1) {
                document.getElementById('username').style.display = "block";
                document.getElementById('email').style.display = "none";
            } else {
                document.getElementById('username').style.display = "none";
                document.getElementById('email').style.display = "block";
            }
        }
    </script>
</body>

</html>