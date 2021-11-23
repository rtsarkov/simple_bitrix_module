<?php
include __DIR__ . '/constants.php';

CModule::AddAutoloadClasses(
    'utlab.app',
    array(
        'Utlab\App\Events\Events' => 'lib/Events/Events.php',
    )
);