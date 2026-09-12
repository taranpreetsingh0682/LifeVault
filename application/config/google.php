<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['google_client_id'] = getenv('GOOGLE_CLIENT_ID') ?: '';
$config['google_client_secret'] = getenv('GOOGLE_CLIENT_SECRET') ?: '';

$google_redirect = getenv('GOOGLE_REDIRECT_URI');
if (empty($google_redirect)) {
    if (isset($_SERVER['HTTP_HOST'])) {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
                    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
                    ? 'https://' : 'http://';
        $script_dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $google_redirect = $protocol . $_SERVER['HTTP_HOST'] . $script_dir . 'auth/googleCallback';
    } else {
        $google_redirect = 'https://lifevault-1.onrender.com/auth/googleCallback';
    }
}
$config['google_redirect_uri'] = $google_redirect;