<?php
function validPassword(string $password): bool {
	return strlen($password) > 8;
}

function validEmail(string $email): bool {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}
