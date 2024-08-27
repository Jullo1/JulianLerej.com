<?php

error_reporting(E_ERROR | E_PARSE);

function base_url( $uri = '' ) {
    return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . $uri;
}

/** 
 * Data Base constants 
 */
$hostname = "localhost";
$username = "edgeaxdu_admin";
$password = "cabito147";
$database = "edgeaxdu_main";

define("DB_HOSTNAME", $hostname);
define("DB_USERNAME", $username);
define("DB_PASSWORD", $password);
define("DB_NAME", $database);




/** 
 * App constants 
 */
define("URL_FRONT", base_url("/"));
define("VIEW", "app/views/");
define("VIEW_ADMIN", "views/");



/**
 * Email registration constants 
 */
define("EMAIL_REGISTRATION_HOST", "mail.julianlerej.com");
define("EMAIL_REGISTRATION_USER", "registration@julianlerej.com");
define("EMAIL_REGISTRATION_PASSWORD", "cabito147");
define("EMAIL_REGISTRATION_FROM_NAME", "Julian Lerej");
$email_from = $email_replay_to = "registration@julianlerej.com";

define("EMAIL_REGISTRATION_FROM", $email_from);
define("EMAIL_REGISTRATION_REPLAY_TO", $email_replay_to);
define("EMAIL_REGISTRATION_SUBJECT", "Thanks for registering");
define("EMAIL_REGISTRATION_HTML_TEMPLATE_PATH", VIEW ."assets/form/acreditacion_mail_template.html");

define("EMAIL_RECOVER_PASSWORD_SUBJECT", "Recover your password");


?>