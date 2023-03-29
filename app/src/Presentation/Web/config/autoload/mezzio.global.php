<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

return [
    // Toggle the configuration cache. Set this to boolean false, or remove the
    // directive, to disable configuration caching. Toggling development mode
    // will also disable it by default; clear the configuration cache using
    // `composer clear-config-cache`.
    ConfigAggregator::ENABLE_CACHE => true,

    // Enable debugging; typically used to provide debugging information within templates.
    'debug'  => false,
    'mezzio' => [
        // Provide templates for the error handling middleware to use when
        // generating responses.
        'error_handler' => [
            'template_404'   => 'sys_view::error_404',  // registered 'folderName/fileName.phtml'   see Handler/Sys
            'template_error' => 'sys_view::error',  // registered 'folderName/fileName.phtml'   see Handler/Sys
            'layout' => 'sys_layout::common',  // registered 'folderName/fileName.phtml'   see Handler/Sys
        ],

    ],
    'templates' => [
        'layout' => 'sys_layout::common',  // registered 'folderName/fileName.phtml'   see Handler/Sys
        'map'    => [
            // template => filename pairs
        ],
        'paths'  => [
            // namespace / path pairs
            //
            // Numeric namespaces imply the default/main namespace. Paths may be
            // strings or arrays of string paths to associate with the namespace.
        ],
    ],
];
