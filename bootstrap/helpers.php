<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', '', strip_tags($value)));
    return str_limit($excerpt, $length);
}

if (!function_exists('manage_contents')) {
    function manage_contents()
    {
        return Auth::check() && Auth::user()->can('manage_contents');
    }
}

if (!function_exists('administrator_users_avatar')) {
    function administrator_users_avatar($avatar, $model)
    {
        return empty($avatar) ? 'N/A' : '<img src="' . $avatar . '" width="40">';
    }
}

if (!function_exists('administrator_users_name')) {
    function administrator_users_name($name, $model)
    {
        return '<a href="/users/' . $model->id . '" target=_blank>' . $name . '</a>';
    }
}