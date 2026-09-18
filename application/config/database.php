<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['dsn']      The full DSN string describe a connection to the database.
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Query Builder class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['encrypt']  Whether or not to use an encrypted connection.
|
|			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
|			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
|
|				'ssl_key'    - Path to the private key file
|				'ssl_cert'   - Path to the public key certificate file
|				'ssl_ca'     - Path to the certificate authority file
|				'ssl_capath' - Path to a directory containing trusted CA certificates in PEM format
|				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
|				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not
|
|	['compress'] Whether or not to use client compression (MySQL only)
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
|	['failover'] array - A array with 0 or more data for connections if the main should fail.
|	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				CodeIgniter will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
*/
$active_group = 'default';
$query_builder = TRUE;

$is_windows = (DIRECTORY_SEPARATOR === '\\');

// 1. Support full Database URL (e.g. Aiven Service URI, Render DATABASE_URL, MYSQL_URL)
$db_url = getenv('DATABASE_URI')
    ?: (getenv('DATABASE_URL')
    ?: (getenv('MYSQL_URL')
    ?: (getenv('DB_URL')
    ?: (getenv('DB_URI')
    ?: (getenv('AIVEN_DATABASE_URL')
    ?: (getenv('AIVEN_SERVICE_URI')
    ?: (getenv('CLEARDB_DATABASE_URL')
    ?: (getenv('JAWSDB_URL') ?: ''))))))));

$url_ssl_required = FALSE;
if (!empty($db_url)) {
    $parsed_url = parse_url($db_url);
    $db_host = !empty($parsed_url['host']) ? $parsed_url['host'] : '127.0.0.1';
    $db_port = !empty($parsed_url['port']) ? (int) $parsed_url['port'] : 3306;
    $db_user = !empty($parsed_url['user']) ? urldecode($parsed_url['user']) : 'root';
    $db_pass = isset($parsed_url['pass']) ? urldecode($parsed_url['pass']) : '';
    $db_name = !empty($parsed_url['path']) ? trim($parsed_url['path'], '/') : 'lifevault';

    if (!empty($parsed_url['query'])) {
        parse_str($parsed_url['query'], $query_params);
        if (
            (isset($query_params['ssl-mode']) && strtoupper($query_params['ssl-mode']) !== 'DISABLED') ||
            (isset($query_params['sslmode']) && strtolower($query_params['sslmode']) !== 'disable') ||
            (isset($query_params['ssl']) && ($query_params['ssl'] === 'true' || $query_params['ssl'] === '1'))
        ) {
            $url_ssl_required = TRUE;
        }
    }
} else {
    // 2. Individual Environment Variables or Local Fallbacks
    $db_host = getenv('DB_HOST')
        ?: (getenv('AIVEN_HOST')
        ?: (getenv('MYSQLHOST')
        ?: (getenv('MYSQL_HOST')
        ?: (getenv('DATABASE_HOST')
        ?: ($is_windows ? '127.0.0.1' : 'db')))));

    $db_port = (int) (getenv('DB_PORT')
        ?: (getenv('AIVEN_PORT')
        ?: (getenv('MYSQLPORT')
        ?: (getenv('MYSQL_PORT')
        ?: (getenv('DATABASE_PORT')
        ?: ($is_windows ? 3307 : 3306))))));

    $db_user = getenv('DB_USERNAME')
        ?: (getenv('DB_USER')
        ?: (getenv('AIVEN_USER')
        ?: (getenv('MYSQLUSER')
        ?: (getenv('MYSQL_USER')
        ?: (getenv('DATABASE_USER') ?: 'root')))));

    $db_pass = getenv('DB_PASSWORD') !== false
        ? getenv('DB_PASSWORD')
        : (getenv('DB_PASS') !== false
        ? getenv('DB_PASS')
        : (getenv('AIVEN_PASSWORD') !== false
        ? getenv('AIVEN_PASSWORD')
        : (getenv('MYSQLPASSWORD') !== false
        ? getenv('MYSQLPASSWORD')
        : (getenv('MYSQL_PASSWORD') !== false
        ? getenv('MYSQL_PASSWORD')
        : (getenv('DATABASE_PASSWORD') !== false
        ? getenv('DATABASE_PASSWORD') : 'root')))));

    $db_name = getenv('DB_DATABASE')
        ?: (getenv('DB_NAME')
        ?: (getenv('AIVEN_DATABASE')
        ?: (getenv('MYSQLDATABASE')
        ?: (getenv('MYSQL_DATABASE')
        ?: (getenv('DATABASE_NAME') ?: 'lifevault')))));
}

$is_remote_db = (!in_array(strtolower($db_host), array('127.0.0.1', 'localhost', 'db', '')));

// 3. SSL Configuration (Required for Aiven MySQL and cloud databases)
$ssl_env = getenv('DB_SSL') ?: getenv('MYSQL_SSL');
$use_ssl = ($ssl_env === 'true' || $ssl_env === '1' || $ssl_env === 'REQUIRED' || $url_ssl_required || ($ssl_env === false && $is_remote_db));

if ($use_ssl) {
    $ca_file = getenv('DB_SSL_CA')
        ?: (getenv('AIVEN_CA_CERT')
        ?: (getenv('AIVEN_CA')
        ?: ((defined('APPPATH') && file_exists(APPPATH . 'config/ca.pem')) ? APPPATH . 'config/ca.pem' : NULL)));

    $encrypt_config = array(
        'ssl_verify' => (getenv('DB_SSL_VERIFY') === 'true' || getenv('DB_SSL_VERIFY') === '1'),
        'ssl_ca'     => $ca_file,
    );
} else {
    $encrypt_config = FALSE;
}

$db['default'] = array(
    'dsn'          => '',
    'hostname'     => $db_host,
    'port'         => $db_port,
    'username'     => $db_user,
    'password'     => $db_pass,
    'database'     => $db_name,
    'dbdriver'     => 'mysqli',
    'dbprefix'     => '',
    'pconnect'     => FALSE,
    'db_debug'     => (ENVIRONMENT !== 'production'),
    'cache_on'     => FALSE,
    'cachedir'     => '',
    'char_set'     => 'utf8mb4',
    'dbcollat'     => 'utf8mb4_general_ci',
    'swap_pre'     => '',
    'encrypt'      => $encrypt_config,
    'compress'     => FALSE,
    'stricton'     => FALSE,
    'failover'     => array(),
    'save_queries' => (ENVIRONMENT !== 'production')
);