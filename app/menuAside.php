<?php
// Aside menu
namespace App;

use App\Models\Message;
use App\Models\User;

class menuAside
{
    static function getManu()
    {
        return [

            'items' => [
                // Dashboard
                [
                    'title' => 'لوحة التحكم',
                    'root' => true,
                    'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '/admin',
                    'new-tab' => false,
                ],


                [
                    'title' => 'الموظفين',
                    'icon' => 'media/svg/icons/Files/User-folder.svg',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'عرض',
                            'page' => 'admin/users',
                        ],
                        [
                            'title' => 'اضافة',
                            'page' => 'admin/users/create',
                        ]
                    ],
                ],
                // Custom
                [
                    'section' => 'الخدمات',
                ],
                [
                    'title' => 'الخطابات',
                    'icon' => 'media/svg/icons/Code/Thunder-circle.svg',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'عرض',
                            'page' => 'admin/letters',
                        ],
                        [
                            'title' => 'اضافة',
                            'page' => 'admin/letters/create',
                        ]
                    ],
                ], [
                    'title' => 'ملفات جاهزة',
                    'icon' => 'media/svg/icons/Code/Thunder-circle.svg',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'عرض',
                            'page' => 'admin/attachments',
                        ],
                        [
                            'title' => 'اضافة',
                            'page' => 'admin/attachments/create',
                        ]
                    ],
                ],
                [
                    'title' => 'فلق',
                    'icon' => 'media/svg/icons/Code/Thunder-circle.svg',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'عرض',
                            'page' => 'admin/galleries',
                        ],
                        [
                            'title' => 'اضافة',
                            'page' => 'admin/galleries/create',
                        ],
                        [
                            'title' => 'الدعوات الجاهزة',
                            'page' => 'admin/invitations',
                        ],
                    ],
                ],
                [
                    'title' => 'قوالب الشكر',
                    'icon' => 'media/svg/icons/Code/Thunder-circle.svg',
                    'bullet' => 'line',
                    'root' => true,
                    'submenu' => [
                        [
                            'title' => 'عرض',
                            'page' => 'admin/thanks',
                        ],
                        [
                            'title' => 'اضافة',
                            'page' => 'admin/thanks/create',
                        ],
                    ],
                ],
//                [
//                    'title' => 'الألبومات',
//                    'icon' => 'media/svg/icons/Code/Thunder-circle.svg',
//                    'bullet' => 'line',
//                    'root' => true,
//                    'submenu' => [
//                        [
//                            'title' => 'عرض',
//                            'page' => 'admin/albums',
//                        ],
//                        [
//                            'title' => 'اضافة',
//                            'page' => 'admin/albums/create',
//                        ]
//                    ],
//                ],

            ],

        ];

    }
}
