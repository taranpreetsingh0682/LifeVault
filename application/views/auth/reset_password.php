<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/life.css?v=' . time()); ?>">
    <title>Reset Password - LifeVault</title>
    <style>
        body{background:#F8F7F0;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1rem}
        .reset-card{max-width:440px;width:100%;background:#fff;border-radius:16px;box-shadow:0 20px 40px rgba(13,18,53,.12);padding:2rem}
        .reset-icon{width:58px;height:58px;background:#EFF6FF;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem}
        .reset-icon i{font-size:1.45rem;color:#2563eb}
        .input-group>.bi-lock,.input-group>.password-toggle{padding:8px;margin:0;background-color:#efefef;color:#A7A4AF;border-radius:8px}
        .input-group>.password-toggle{cursor:pointer}
        .btn-primary{background:#0D1235;border:none;padding:.75rem 1rem;width:100%;border-radius:10px;font-weight:600}
        .btn-primary:hover{background:#1a2250}
    </style>
</head>
<body>
    <div class="reset-card">
        <div class="reset-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        <h4 class="text-center fw-bold mb-2" style="color:#0D1235;">Set New Password</h4>
        <p class="text-muted text-center mb-4">Enter your new password below.</p>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?= form_open('Auth/updatePassword'); ?>
            <input type="hidden" name="token" value="<?= html_escape($token); ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <div class="input-group">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" id="newPassword" class="form-control" placeholder="Enter new password" required minlength="6">
                    <i class="bi bi-eye password-toggle" data-target="newPassword" title="Show password"></i>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Confirm Password</label>
                <div class="input-group">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="confirm_password" id="confirmNewPassword" class="form-control" placeholder="Confirm new password" required minlength="6">
                    <i class="bi bi-eye password-toggle" data-target="confirmNewPassword" title="Show password"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        <?= form_close(); ?>

        <p class="text-center mt-3 mb-0">
            <a href="<?= site_url('Auth/login'); ?>">Back to Login</a>
        </p>
    </div>

    <script>
    document.querySelectorAll('.password-toggle').forEach(function(toggle){
        toggle.addEventListener('click',function(){
            var input=document.getElementById(this.getAttribute('data-target'));
            if(!input)return;
            if(input.type==='password'){
                input.type='text';
                this.classList.replace('bi-eye','bi-eye-slash');
            }else{
                input.type='password';
                this.classList.replace('bi-eye-slash','bi-eye');
            }
        });
    });
    </script>
</body>
</html>
