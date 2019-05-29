<?php

return [
    'adminEmail' => '',

    // Project related params
    'project' => [
        'name' => 'Plan Manager',
        'version' => 1.1,
        'author' => 'iproman',
    ],
    'cache' => [
        'day' => 86400,
    ],
    'editableAttributesMap' => [
        'app\models\entities\Task' => [
            'name',
            'branch',
            'status',
        ],
        'app\models\entities\Project' => [
            'name',
            'branch',
            'sort',
            'color',
        ],
    ]
];
