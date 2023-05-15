<?php

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
};

function testResponse($value) {
    $response = json_encode($value);
    echo $response;
}

// function navStyle($value) {
//     if ($_SERVER['REQUEST_URI'] == $value) {
//         return 'bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium'; 
//     } else {
//         return 'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium';
//     };
// };

function abort($code = Response::NOT_FOUND) {
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN) 
{
    if (! $condition) {
        abort($status);
    }
}

function base_path($path) 
{
    return BASE_PATH . $path;
}

function view($path, $attributes = []) 
{
    extract($attributes);

    require base_path('views/' . $path);
}