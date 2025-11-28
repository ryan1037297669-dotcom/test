<?php
// Simple login demo for CLI usage.
// Usage: php login_demo.php <username> <password>

// In-memory user store with hashed passwords.
$users = [
    'alice' => password_hash('password123', PASSWORD_DEFAULT),
    'bob'   => password_hash('secret456', PASSWORD_DEFAULT),
];

/**
 * Attempt to authenticate the given credentials.
 */
function authenticate(string $username, string $password, array $users): ?string
{
    if (!isset($users[$username])) {
        return null;
    }

    if (!password_verify($password, $users[$username])) {
        return null;
    }

    // Return a simple session token.
    return bin2hex(random_bytes(16));
}

$username = $argv[1] ?? '';
$password = $argv[2] ?? '';

if ($username === '' || $password === '') {
    fwrite(STDERR, "Usage: php login_demo.php <username> <password>\n");
    exit(1);
}

$token = authenticate($username, $password, $users);

if ($token === null) {
    fwrite(STDOUT, "Login failed: invalid username or password.\n");
    exit(1);
}

fwrite(STDOUT, "Login successful! Session token: {$token}\n");
?>
