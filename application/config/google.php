<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['google_client_id'] = getenv('GOOGLE_CLIENT_ID') ?: '';

$config['google_client_secret'] = getenv('GOOGLE_CLIENT_SECRET') ?: '';


$config['google_redirect_uri'] = getenv('GOOGLE_REDIRECT_URI') ?: '';