<?php

return [
    'paths' => [
        resource_path('views'),
    ],

    // Kita langsung tembak foldernya tanpa realpath() atau env()
    'compiled' => storage_path('framework/views'),
];
