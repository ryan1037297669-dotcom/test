<?php
// Simple demo script
function greet(string $name): string {
    return "Hello, {$name}!";
}

$name = $argv[1] ?? 'World';
printf("%s\n", greet($name));
?>
