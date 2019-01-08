<?php

use App\Models\User;

return [
    'title' => '用户',
    'single' => '用户',
    'model' => User::class,
    'permission' => 'manage_contents',
    // 字段渲染数据表格
    'columns' => [
        'id',
        'avatar' => [
            'title' => '头像',
            'output' => 'administrator_users_avatar',
            'sortable' => false,
        ],
        'name' => [
            'title' => '用户名',
            'sortable' => false,
            'output' => 'administrator_users_name',
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],
    // 模型表单设置项
    'edit_fields' => [
        'name' => ['title' => '用户名'],
        'email' => ['title' => '邮箱'],
        'password' => [
            'title' => '密码',
            'type' => 'password',
        ],
        'avatar' => [
            'title' => '头像',
            'type' => 'image',
            'location' => public_path() . '/uploads/images/avatars/',
        ],
        'roles' => [
            'title' => '用户角色',
            'type' => 'relationship',
            'name_field' => 'name',
        ],
    ],
    // 数据过滤
    'filters' => [
        'id' => ['title' => '用户ID'],
        'name' => ['title' => '用户名'],
        'email' => ['title' => '邮箱'],
    ],

];