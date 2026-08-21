<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - LifeVault</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('assets/life.css?v=' . time()); ?>">

    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
        }
        .forgot-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(13, 18, 53, 0.1), 0 8px 10px -6px rgba(13, 18, 53, 0.1);
            border: none;
            padding: 2.5rem 2rem !important;
        }
        .btn-primary {
            background-color: #0D1235;
            border-color: #0D1235;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background-color: #1a2256;
            border-color: #1a2256;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #D1D5DB;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #0D1235;
            box-shadow: 0 0 0 3px rgba(13, 18, 53, 0.15);
        }
        .input-group-text {
            background-color: #F9FAFB;
            border-color: #D1D5DB;
            color: #6B7280;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            padding: 0.75rem 1rem;
        }
        .input-group .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .move a {
            color: #0D1235;
            font-weight: 500;
            text-decoration: none;
            font-size: 0.95rem;
        }
        .move a:hover {
            text-decoration: underline;
        }
        .card-container {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card-container">
        <div class="card forgot-card">
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-shield-lock text-primary" style="font-size: 3rem; color: #0D1235 !important;"></i>
                </div>
                <h3 class="fw-bold" style="color: #0D1235; margin: 0 0 8px 0; padding: 0;">Forgot Password?</h3>
                <p class="text-muted" style="font-size: 14px; margin: 0; padding: 0; line-height: 1.5;">
                    Enter your registered email address below, and we'll send you a password reset link.
                </p>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('auth/sendResetLink'); ?>" method="post" autocomplete="off" style="margin: 0; padding: 0;">
                <div class="mb-4" style="margin: 0 0 20px 0; padding: 0;">
                    <label class="form-label fw-semibold small" style="color: #4B5563; margin: 0 0 8px 0; padding: 0; display: block;">
                        Email Address <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" required autocomplete="off">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3" style="margin: 0 0 15px 0;">
                    Send Reset Link
                </button>
            </form>

            <div class="text-center move" style="margin: 0; padding: 0;">
                <a href="<?= site_url('auth/login'); ?>"><i class="bi bi-arrow-left me-1"></i> Back to Login</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>