<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';

$config['smtp_host'] = getenv('SMTP_HOST') ?: 'smtp-relay.brevo.com';

$config['smtp_port'] = getenv('SMTP_PORT') ?: 587;

$config['smtp_user'] = getenv('SMTP_USER') ?: '';

$config['smtp_pass'] = getenv('SMTP_PASSWORD') ?: '';


$config['smtp_crypto'] = 'tls';

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';

$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$config['smtp_timeout'] = 15;
$config['from_email'] = getenv('MAIL_FROM_ADDRESS') ?: '';
$config['from_name'] = getenv('MAIL_FROM_NAME') ?: 'LifeVault';
