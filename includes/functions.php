<?php

define('LINKS_FILE',  __DIR__ . '/../data/links.json');
define('CONFIG_FILE', __DIR__ . '/../data/config.json');

function getLinks(): array {
    if (!file_exists(LINKS_FILE)) return [];
    return json_decode(file_get_contents(LINKS_FILE), true) ?? [];
}

function getConfig(): array {
    if (!file_exists(CONFIG_FILE)) return [];
    return json_decode(file_get_contents(CONFIG_FILE), true) ?? [];
}

function isLoggedIn(): bool {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
