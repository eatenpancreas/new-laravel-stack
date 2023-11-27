<?php

namespace App\Lib;

class ApiLibrary
{
    static function defaultResponder(string $status = "running"): \Closure
    {
        return function () use ($status) {
            return json_encode([
                'res_type' => 'status',
                'status' => $status
            ]);
        };
    }
}