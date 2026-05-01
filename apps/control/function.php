<?php
// Encryption key (keep it secret, don't expose publicly)
define('SECRET_KEY', 'myStrongSecretKey2025');
define('SECRET_IV', 'mySecretIV12345');

function encrypt_id($id) {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    return base64_encode(openssl_encrypt($id, "AES-256-CBC", $key, 0, $iv));
}

function decrypt_id($encrypted_id) {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    return openssl_decrypt(base64_decode($encrypted_id), "AES-256-CBC", $key, 0, $iv);
}
?>
