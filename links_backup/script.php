<?php

declare(strict_types=1);

$backend = file_get_contents(__DIR__ . '/../grades/backend/backend.md');
$frontend = file_get_contents(__DIR__ . '/../grades/frontend/frontend.md');
$devops = file_get_contents(__DIR__ . '/../grades/devops/devops.md');

if ($backend) {
    backup($backend);
}

if ($frontend) {
    backup($frontend);
}

if ($devops) {
    backup($devops);
}

function backup(string $file) {

    preg_match_all("/\(([^\)]*)\)/", $file, $matches);

    $command = 'wget -E -H -k --tries=1 ';

    foreach ($matches[1] as $match) {
        try {
            if (str_starts_with($match, 'http')) {
                exec($command . $match);
            }
        } catch (Exception $e) {

        }
    }
}
