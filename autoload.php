<?php

set_include_path(
    implode(
        PATH_SEPARATOR,
        [__DIR__, get_include_path()],
    ),
);

spl_autoload_register(function ($class) {
    $sources = [
        __DIR__ . "/app/controllers/$class.php",
        __DIR__ . "/app/models/$class.php",
    ];

    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
        }
    }
});
