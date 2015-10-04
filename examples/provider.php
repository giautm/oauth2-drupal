<?php


require __DIR__ . '/../vendor/autoload.php';

// Replace these with your token settings
// Create a project at https://console.developers.google.com/
$clientId = 'local-client';
$clientSecret = 'local-client';

// Change this if you are not using the built-in PHP server
$redirectUri = 'http://localhost:8080/';

$baseUrl = 'http://taphoa24h.vn/drupal-7.39';

// Start the session
session_start();

// Initialize the provider
$provider = new GiauTM\OAuth2\Client\Provider\Drupal(
    compact('clientId', 'clientSecret', 'redirectUri', 'baseUrl'));

// No HTML for demo, prevents any attempt at XSS
header('Content-Type', 'text/plain');

return $provider;
