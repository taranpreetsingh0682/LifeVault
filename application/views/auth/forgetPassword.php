<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - LifeVault</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/life.css?v=' . time()); ?>">

</head>

<body>

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height:100vh;">

        <div class="col-md-5">

            <div class="card shadow border-0 p-4">

                <div class="text-center">

                    <h2>
                        Forgot Password?
                    </h2>

                    <p class="text-muted">
                        Enter your registered email address.
                    </p>

                </div>


                <?php if ($this->session->flashdata('error')): ?>

                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error'); ?>
                    </div>

                <?php endif; ?>


                <form action="<?= site_url('auth/sendResetLink'); ?>"
                      method="post">

                    <div class="mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="you@example.com"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary w-100 button">

                        Send Reset Link

                    </button>

                </form>


                <div class="text-center mt-3 move">

                    <a href="<?= site_url('auth/login'); ?>">
                        Back to Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>