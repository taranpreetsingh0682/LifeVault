<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        $this->load->library('session');
        $this->config->load('google');
        $this->load->model('User_model');

        $this->load->view('auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */


    public function testSession()
{
    $this->load->library('session');

    $this->session->set_userdata(
        'test_session',
        'HELLO_LIFEvault'
    );

    echo '<pre>';
    echo "Configured save path: ";
    var_dump(config_item('sess_save_path'));

    echo "\nSession ID: ";
    var_dump($this->session->session_id);

    echo "\nSession value: ";
    var_dump($this->session->userdata('test_session'));
    echo '</pre>';
}
    public function googleLogin()
    {
        $this->load->library('session');
        $this->config->load('google');

        $state = bin2hex(random_bytes(32));

        $this->session->set_userdata(
            'google_oauth_state',
            $state
        );

        $google_url =
            'https://accounts.google.com/o/oauth2/v2/auth?' .
            http_build_query([
                'client_id' =>
                    $this->config->item('google_client_id'),

                'redirect_uri' =>
                    $this->config->item('google_redirect_uri'),

                'response_type' => 'code',

                'scope' => 'openid email profile',

                'access_type' => 'online',

                'state' => $state
            ]);

        redirect($google_url);
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE CALLBACK
    |--------------------------------------------------------------------------
    */
    public function googleCallback()
    {
        log_message('error', 'GOOGLE CALLBACK STARTED');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->config->load('google');


        // 1. Google returned an error
        if ($this->input->get('error')) {

            $this->session->set_flashdata(
                'error',
                'Google login was cancelled or denied.'
            );

            redirect('auth/login');
            return;
        }


        // 2. Get authorization code
        $code = $this->input->get('code');

        if (empty($code)) {

            $this->session->set_flashdata(
                'error',
                'Google authorization code was not received.'
            );

            redirect('auth/login');
            return;
        }


        // 3. Verify OAuth state
        $state = $this->input->get('state');

        $saved_state =
            $this->session->userdata('google_oauth_state');

        if (
            empty($state) ||
            empty($saved_state) ||
            !hash_equals($saved_state, $state)
        ) {

            $this->session->set_flashdata(
                'error',
                'Invalid Google login request.'
            );

            redirect('auth/login');
            return;
        }


        // Remove state after validation
        $this->session->unset_userdata(
            'google_oauth_state'
        );


        // 4. Exchange code for access token
        $token_url =
            'https://oauth2.googleapis.com/token';

        $post_data = [
            'code' => $code,

            'client_id' =>
                $this->config->item('google_client_id'),

            'client_secret' =>
                $this->config->item('google_client_secret'),

            'redirect_uri' =>
                $this->config->item('google_redirect_uri'),

            'grant_type' => 'authorization_code'
        ];


        $ch = curl_init($token_url);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query($post_data)
        );

        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/x-www-form-urlencoded'
            ]
        );


        $token_response = curl_exec($ch);


        if ($token_response === false) {

            curl_close($ch);

            $this->session->set_flashdata(
                'error',
                'Unable to connect to Google.'
            );

            redirect('auth/login');
            return;
        }


        curl_close($ch);


        $token_data =
            json_decode($token_response, true);


        if (
            empty($token_data['access_token'])
        ) {

            $this->session->set_flashdata(
                'error',
                'Unable to get Google access token.'
            );

            redirect('auth/login');
            return;
        }


        $access_token =
            $token_data['access_token'];


        // 5. Get Google user information
        $userinfo_url =
            'https://openidconnect.googleapis.com/v1/userinfo';


        $ch = curl_init($userinfo_url);

        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Authorization: Bearer ' . $access_token
            ]
        );


        $userinfo_response =
            curl_exec($ch);


        if ($userinfo_response === false) {

            curl_close($ch);

            $this->session->set_flashdata(
                'error',
                'Unable to retrieve Google account information.'
            );

            redirect('auth/login');
            return;
        }


        curl_close($ch);


        $google_user =
            json_decode($userinfo_response);


        if (empty($google_user->email)) {

            $this->session->set_flashdata(
                'error',
                'Google did not provide an email address.'
            );

            redirect('auth/login');
            return;
        }


        // 6. Find user
        $user =
            $this->User_model->getUserByEmail(
                $google_user->email
            );


        // 7. Existing user
        if ($user) {

            $session_data = [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'loggend_in' => TRUE
            ];


            $this->session->set_userdata(
                $session_data
            );


            // Create remember token
            $this->createRememberToken(
                $user->id
            );


            redirect('dashboard/dashboard');
            return;
        }


        // 8. New Google user
        $data = [
            'name' => $google_user->name,

            'email' => $google_user->email,

            'country' => '',

            'phone_number' => '',

            'password' => password_hash(
                bin2hex(random_bytes(32)),
                PASSWORD_DEFAULT
            )
        ];


        $inserted =
            $this->User_model->insertUser($data);


        if (!$inserted) {

            $this->session->set_flashdata(
                'error',
                'Unable to create your LifeVault account.'
            );

            redirect('auth/login');
            return;
        }


        // 9. Get newly created user
        $user =
            $this->User_model->getUserByEmail(
                $google_user->email
            );


        if (!$user) {

            $this->session->set_flashdata(
                'error',
                'Unable to retrieve newly created account.'
            );

            redirect('auth/login');
            return;
        }


        // 10. Create session
        $session_data = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'loggend_in' => TRUE
        ];


        $this->session->set_userdata(
            $session_data
        );


        // Create remember token
        $this->createRememberToken(
            $user->id
        );


        // Send welcome email to new Google user
        $this->sendWelcomeEmail(
            $user->email,
            $user->name
        );


        // 11. Dashboard
        redirect('dashboard/dashboard');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | MANUAL LOGIN
    |--------------------------------------------------------------------------
    */
    public function loginUser()
    {
        $this->load->model('User_model');
        $this->load->library('session');


        $email =
            trim($this->input->post('email'));

        $password =
            $this->input->post('password');

if (empty($email) || empty($password)) {

    $this->session->set_flashdata(
        'error',
        'Please enter both email and password.'
    );

    redirect('auth/login');
    return;
}
        // Find user
        $user =
            $this->User_model->getUserByEmail($email);


        if (!$user) {

            $this->session->set_flashdata(
                'error',
                'No account found with this email.'
            );

            redirect('auth/login');
            return;
        }


        // Verify password
        if (
            !password_verify(
                $password,
                $user->password
            )
        ) {

            $this->session->set_flashdata(
                'error',
                'Invalid password.'
            );

            redirect('auth/login');
            return;
        }


        // Create session
        $session_data = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'loggend_in' => TRUE
        ];


        $this->session->set_userdata(
            $session_data
        );


        // Create remember token
        $this->createRememberToken(
            $user->id
        );


        redirect('dashboard/dashboard');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | TEST EMAIL
    |--------------------------------------------------------------------------
    */
   public function testEmail()
{
    // Load email configuration
    $this->config->load('email', TRUE);

    // SMTP configuration
    $config = [
        'protocol'    => $this->config->item('protocol', 'email'),
        'smtp_host'   => $this->config->item('smtp_host', 'email'),
        'smtp_port'   => $this->config->item('smtp_port', 'email'),
        'smtp_user'   => $this->config->item('smtp_user', 'email'),
        'smtp_pass'   => $this->config->item('smtp_pass', 'email'),
        'smtp_crypto' => $this->config->item('smtp_crypto', 'email'),
        'smtp_timeout' => $this->config->item('smtp_timeout', 'email'),
        'mailtype'    => $this->config->item('mailtype', 'email'),
        'charset'     => $this->config->item('charset', 'email'),
        'newline'     => "\r\n",
        'crlf'        => "\r\n",
    ];

    // Initialize email library
    $this->load->library('email');
    $this->email->clear();
    $this->email->initialize($config);

    // Sender
    $this->email->from(
        $this->config->item('from_email', 'email'),
        $this->config->item('from_name', 'email')
    );

    // Test recipient
    $this->email->to('lifevaultsys@gmail.com');

    $this->email->subject('LifeVault Email Test');

    $message = '
        <h2>Welcome to LifeVault! 🎉</h2>

        <p>
            Your LifeVault email notification system
            is working successfully.
        </p>

        <p>
            SMTP configuration is working correctly.
        </p>

        <br>

        <p>
            Regards,<br>
            <strong>LifeVault Team</strong>
        </p>
    ';

    $this->email->message($message);

    if ($this->email->send()) {

        echo "Email sent successfully.";

    } else {

        echo "<pre>";
        echo $this->email->print_debugger();
        echo "</pre>";
    }
}


    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD PAGE
    |--------------------------------------------------------------------------
    */
    public function forgetPassword()
    {
        $this->load->library('session');
        $this->load->model('User_model');

        $this->load->view(
            'auth/forgetPassword'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */
    public function register()
    {
        $this->load->model('User_model');

        $this->load->view(
            'auth/register'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HOME PAGE
    |--------------------------------------------------------------------------
    */
    public function home()
    {
        $this->load->model('User_model');

        $this->load->view(
            'auth/Home'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout()
    {
        $this->load->library('session');
        $this->load->model('User_model');


        $user_id =
            $this->session->userdata('user_id');


        // Clear database remember token
        if ($user_id) {

            $this->User_model->clearRememberToken(
                $user_id
            );
        }


        // Delete browser cookie
        delete_cookie(
            'lifevault_remember'
        );


        // Unset all session data
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('loggend_in');

        // Destroy the session completely
        $this->session->sess_destroy();

        // Also destroy via native PHP to ensure nothing is left
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }

        // Delete the session cookie from browser
        if (isset($_COOKIE[config_item('sess_cookie_name')])) {
            setcookie(
                config_item('sess_cookie_name'),
                '',
                time() - 3600,
                '/'
            );
        }

        redirect('auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | SEND RESET LINK
    |--------------------------------------------------------------------------
    */
   public function sendResetLink()
{
    $this->load->model('User_model');
    $this->load->library('session');

    $email = trim($this->input->post('email'));

    if (empty($email)) {

        $this->session->set_flashdata(
            'error',
            'Please enter your email address.'
        );

        $this->session->set_flashdata(
            'open_forgot_modal',
            TRUE
        );

        redirect('auth/login');
        return;
    }

    $user = $this->User_model->getUserByEmail($email);

    /*
    |--------------------------------------------------------------------------
    | SECURITY
    |--------------------------------------------------------------------------
    | Don't reveal whether an email exists or not.
    */
    if (!$user) {

        $this->session->set_flashdata(
            'success',
            'If an account exists with this email, a password reset link has been sent.'
        );

        redirect('auth/login');
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE RESET TOKEN
    |--------------------------------------------------------------------------
    */

    $token = bin2hex(
        random_bytes(32)
    );

    $expires = date(
        'Y-m-d H:i:s',
        time() + 3600
    );

    $data = [
        'reset_token'   => $token,
        'reset_expires' => $expires
    ];

    $this->User_model->saveResetToken(
        $user->id,
        $data
    );

    /*
    |--------------------------------------------------------------------------
    | RESET LINK
    |--------------------------------------------------------------------------
    */

    $reset_link = site_url(
        'auth/resetPassword/' . $token
    );

    /*
    |--------------------------------------------------------------------------
    | LOAD EMAIL CONFIG
    |--------------------------------------------------------------------------
    */

    $this->config->load('email', TRUE);

    $config = [
        'protocol'    => $this->config->item('protocol', 'email'),
        'smtp_host'   => $this->config->item('smtp_host', 'email'),
        'smtp_port'   => $this->config->item('smtp_port', 'email'),
        'smtp_user'   => $this->config->item('smtp_user', 'email'),
        'smtp_pass'   => $this->config->item('smtp_pass', 'email'),
        'smtp_crypto' => $this->config->item('smtp_crypto', 'email'),
        'smtp_timeout' => $this->config->item('smtp_timeout', 'email'),
        'mailtype'    => 'html',
        'charset'     => 'utf-8',
        'newline'     => "\r\n",
        'crlf'        => "\r\n"
    ];

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE EMAIL
    |--------------------------------------------------------------------------
    */

    $this->load->library('email');

    $this->email->clear();
    $this->email->initialize($config);

    /*
    |--------------------------------------------------------------------------
    | EMAIL
    |--------------------------------------------------------------------------
    */

    $safe_name = htmlspecialchars(
        $user->name,
        ENT_QUOTES,
        'UTF-8'
    );

    $this->email->from(
        $this->config->item('from_email', 'email'),
        $this->config->item('from_name', 'email')
    );

    $this->email->to($user->email);

    $this->email->subject(
        'LifeVault - Password Reset'
    );

    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Password Reset</title>
    </head>

    <body style="margin:0;padding:0;background:#f0f4ff;font-family:Arial,sans-serif;">

        <div style="max-width:600px;margin:40px auto;background:#ffffff;border-radius:16px;overflow:hidden;">

            <div style="background:#0D1235;padding:30px;text-align:center;">
                <h1 style="color:#ffffff;margin:0;">
                    LifeVault
                </h1>

                <p style="color:#dbe4ff;">
                    SECURE . PRIVATE . YOURS
                </p>
            </div>

            <div style="padding:40px;text-align:center;">

                <h2 style="color:#0D1235;">
                    Password Reset
                </h2>

                <p style="color:#555;font-size:16px;line-height:1.6;">
                    Hello ' . $safe_name . ',
                </p>

                <p style="color:#555;font-size:16px;line-height:1.6;">
                    We received a request to reset your LifeVault password.
                </p>

                <p style="color:#555;font-size:16px;line-height:1.6;">
                    Click the button below to create a new password.
                </p>

                <div style="margin:30px 0;">

                    <a href="' . $reset_link . '"
                       style="display:inline-block;
                              background:#0D1235;
                              color:#ffffff;
                              padding:14px 28px;
                              border-radius:8px;
                              text-decoration:none;
                              font-weight:bold;">
                        Reset Password
                    </a>

                </div>

                <p style="color:#777;font-size:14px;line-height:1.5;">
                    This password reset link will expire in 1 hour.
                </p>

                <p style="color:#999;font-size:13px;line-height:1.5;">
                    If you did not request a password reset, you can safely ignore this email.
                </p>

            </div>

        </div>

    </body>
    </html>
    ';
    $this->email->set_mailtype('html');
    $this->email->message($message);

    /*
    |--------------------------------------------------------------------------
    | SEND EMAIL
    |--------------------------------------------------------------------------
    */

    if (!$this->email->send()) {

        log_message(
            'error',
            'PASSWORD RESET EMAIL FAILED: ' .
            $this->email->print_debugger(['headers'])
        );

        $this->session->set_flashdata(
            'error',
            'Unable to send password reset email. Please try again later.'
        );

        redirect('auth/login');
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

    $this->session->set_flashdata(
        'success',
        'If an account exists with this email, a password reset link has been sent to your email.'
    );

    redirect('auth/login');
}


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD PAGE
    |--------------------------------------------------------------------------
    */
    public function resetPassword($token = NULL)
    {
        $this->load->model('User_model');
        $this->load->library('session');


        if (empty($token)) {

            redirect('auth/login');
            return;
        }


        $user =
            $this->User_model->getUserByResetToken(
                $token
            );


        if (
            !$user ||
            empty($user->reset_expires) ||
            strtotime($user->reset_expires) < time()
        ) {

            $this->session->set_flashdata(
                'error',
                'This reset link is invalid or has expired. Please request a new one.'
            );

            redirect('auth/login');
            return;
        }


        $this->load->view(
            'auth/reset_password',
            [
                'token' => $token
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */
    public function updatePassword()
    {
        $this->load->model('User_model');
        $this->load->library('session');


        $token =
            $this->input->post('token');

        $password =
            $this->input->post('password');

        $confirm_password =
            $this->input->post('confirm_password');


        if (
            empty($password) ||
            strlen($password) < 6
        ) {

            $this->session->set_flashdata(
                'error',
                'Password must be at least 6 characters.'
            );

            redirect(
                'auth/resetPassword/' . $token
            );

            return;
        }


        if (
            $password !== $confirm_password
        ) {

            $this->session->set_flashdata(
                'error',
                'Passwords do not match.'
            );

            redirect(
                'auth/resetPassword/' . $token
            );

            return;
        }


        $user =
            $this->User_model->getUserByResetToken(
                $token
            );


        if (
            !$user ||
            empty($user->reset_expires) ||
            strtotime($user->reset_expires) < time()
        ) {

            $this->session->set_flashdata(
                'error',
                'This reset link is invalid or has expired. Please request a new one.'
            );

            redirect('auth/login');
            return;
        }


        // Update password
        $this->User_model->updatePassword(
            $user->id,
            password_hash(
                $password,
                PASSWORD_DEFAULT
            )
        );


        // Clear reset token
        $this->User_model->clearResetToken(
            $user->id
        );


        $this->session->set_flashdata(
            'success',
            'Your password has been updated. You can now login with your new password.'
        );


        redirect('auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER USER
    |--------------------------------------------------------------------------
    */
public function registerUser()
{
    $this->load->model('User_model');
    $this->load->library('session');

    $name = trim($this->input->post('name'));
    $email = trim($this->input->post('email'));
    $country = trim($this->input->post('country'));
    $phone_number = trim($this->input->post('phone_number'));
    $password = $this->input->post('password');

    if (empty($name) || empty($email) || empty($password)) {

        $this->session->set_flashdata(
            'error',
            'Please fill all required fields.'
        );

        redirect('auth/register');
        return;
    }

    // Check duplicate email
    $existing_user = $this->User_model->getUserByEmail($email);

    if ($existing_user) {

        $this->session->set_flashdata(
            'error',
            'An account with this email already exists.'
        );

        redirect('auth/register');
        return;
    }

    $data = [
        'name' => $name,
        'email' => $email,
        'country' => $country,
        'phone_number' => $phone_number,
        'password' => password_hash(
            $password,
            PASSWORD_DEFAULT
        )
    ];

    // Insert user
    $inserted = $this->User_model->insertUser($data);

    if (!$inserted) {

        $db_error = $this->db->error();

        log_message(
            'error',
            'REGISTER DATABASE ERROR: ' .
            json_encode($db_error)
        );

        $this->session->set_flashdata(
            'error',
            'Unable to create account. Please try again.'
        );

        redirect('auth/register');
        return;
    }

    // Account created successfully
    $this->session->set_flashdata(
        'success',
        'Account created successfully! You can now login.'
    );

    /*
     * TEMPORARILY disabled.
     * First confirm registration works.
     */
     $this->sendWelcomeEmail($email, $name);

    redirect('auth/login');
    return;
}


/*
|--------------------------------------------------------------------------
| WELCOME EMAIL
|--------------------------------------------------------------------------
*/
private function sendWelcomeEmail($email, $name)
{
    // Load email configuration
    $this->config->load('email', TRUE);

    // SMTP configuration
    $config = [
        'protocol'    => $this->config->item('protocol', 'email'),
        'smtp_host'   => $this->config->item('smtp_host', 'email'),
        'smtp_port'   => $this->config->item('smtp_port', 'email'),
        'smtp_user'   => $this->config->item('smtp_user', 'email'),
        'smtp_pass'   => $this->config->item('smtp_pass', 'email'),
        'smtp_crypto' => $this->config->item('smtp_crypto', 'email'),
        'smtp_timeout' => $this->config->item('smtp_timeout', 'email'),
        'mailtype'    => $this->config->item('mailtype', 'email'),
        'charset'     => $this->config->item('charset', 'email'),
        'newline'     => "\r\n",
        'crlf'        => "\r\n",
    ];

    // Initialize email library
    $this->load->library('email');
    $this->email->clear();
    $this->email->initialize($config);

    // Safe name for HTML
    $safe_name = htmlspecialchars(
        $name,
        ENT_QUOTES,
        'UTF-8'
    );

    // Sender
    $this->email->from(
        $this->config->item('from_email', 'email'),
        $this->config->item('from_name', 'email')
    );

    // Recipient
    $this->email->to($email);

    // Subject
    $this->email->subject(
        'Welcome to LifeVault - Your vault is ready!'
    );

    // Email body
    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to LifeVault</title>
    </head>

    <body style="margin:0;padding:0;background:#f0f4ff;font-family:Arial,sans-serif;">

        <div style="max-width:600px;margin:40px auto;background:#ffffff;border-radius:16px;overflow:hidden;">

            <div style="background:#0D1235;padding:35px;text-align:center;">
                <h1 style="color:#ffffff;margin:0;">
                    LifeVault
                </h1>

                <p style="color:#dbe4ff;">
                    SECURE . PRIVATE . YOURS
                </p>
            </div>

            <div style="padding:40px;text-align:center;">

                <div style="font-size:45px;">
                    🎉
                </div>

                <h2 style="color:#0D1235;">
                    Welcome, ' . $safe_name . '!
                </h2>

                <p style="color:#555;font-size:16px;line-height:1.6;">
                    Your LifeVault account has been successfully created.
                </p>

                <p style="color:#555;font-size:16px;line-height:1.6;">
                    You can now securely store, manage and access
                    your important documents anytime, anywhere.
                </p>

                <div style="margin:30px 0;padding:20px;background:#f0f4ff;border-radius:10px;">
                    <strong style="color:#0D1235;">
                        Your digital vault is ready 🔐
                    </strong>
                </div>

                <p style="color:#777;">
                    Thank you for choosing LifeVault.
                </p>

                <p style="color:#555;">
                    Regards,<br>
                    <strong>LifeVault Team</strong>
                </p>

            </div>

            <div style="background:#f7f8fc;padding:20px;text-align:center;">
                <p style="margin:0;color:#888;font-size:13px;">
                    © 2026 LifeVault. All rights reserved.
                </p>
            </div>

        </div>

    </body>
    </html>
    ';

    $this->email->message($message);

    // Send email
    if (!$this->email->send()) {

        log_message(
            'error',
            'WELCOME EMAIL FAILED: ' .
            $this->email->print_debugger()
        );
    }
}

    /*
    |--------------------------------------------------------------------------
    | CREATE REMEMBER TOKEN
    |--------------------------------------------------------------------------
    */
    private function createRememberToken($user_id)
    {
        $this->load->model('User_model');


        // Generate random token
        $token =
            bin2hex(
                random_bytes(32)
            );


        // Hash token for database
        $token_hash =
            hash(
                'sha256',
                $token
            );


        // Token valid for 30 days
        $expires =
            date(
                'Y-m-d H:i:s',
                time() + (30 * 24 * 60 * 60)
            );


        // Save hash and expiry
        $this->User_model->saveRememberToken(
            $user_id,
            $token_hash,
            $expires
        );


        // Store raw token in browser cookie
        set_cookie(
            'lifevault_remember',
            $token,
            30 * 24 * 60 * 60
        );
    }
}
