<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

        [
            'section' => 'Sections & Projects',
        ],
        [
            'title' => 'Manage Sections',
            'icon' => 'media/svg/icons/Design/PenAndRuller.svg',
            'root' => true,
            'bullet' => 'dot',
            'page' => 'departments',
        ],
        [
            'title' => 'Manage Projects',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List Projects',
                    'bullet' => 'dot',
                    'page' => 'projects',
                ],
                [
                    'title' => 'Project Report',
                    'bullet' => 'dot',
                    'page' => 'project_report',
                ],
            ]
        ],
        [
            'section' => 'Users & Privilege',
        ],
        [
            'title' => 'Manage Users',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'root' => true,
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List Users',
                    'bullet' => 'dot',
                    'page' => 'users',
                ],
                [
                    'title' => 'List Users Log Track',
                    'bullet' => 'dot',
                    'page' => 'list_users_log',
                ]
            ]
        ],
        [
            'title' => 'Manage Roles',
            'icon' => 'media/svg/icons/Shopping/Barcode-read.svg',
            'root' => true,
            'bullet' => 'dot',
            'page' => 'roles',
        ],
        [
            'section' => 'Miscellaneous',
        ],
        [
            'title' => 'Fiscal Year',
            'icon' => 'media/svg/icons/Design/Select.svg',
            'root' => true,
            'bullet' => 'dot',
            'page' => 'fiscal_years',
        ],
        [
            'title' => 'Consultant/Operator',
            'icon' => 'media/svg/icons/Layout/Layout-arrange.svg',
            'root' => true,
            'bullet' => 'dot',
            'page' => 'license_operators',
        ],
        // [
        //     'title' => 'Manage User Previlege',
        //     'icon' => 'media/svg/icons/Design/PenAndRuller.svg',
        //     'root' => true,
        //     'bullet' => 'dot',
        //     'page' => 'users',
        // ],
    ]

];
