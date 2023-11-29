<?php
function is_admin_auth() {
	return isset($_SESSION["admin_auth"]);
}

function set_admin_auth($state = false){
	$_SESSION["admin_auth"] = $state;
}

function is_user_auth() {
	return isset($_SESSION["user_auth"]);
}

function set_user_auth($state = false){
	$_SESSION["user_auth"] = $state;
}

?>
