<?php

namespace App\Helpers;

class UrlHelper {
    public static function url($routeName, $params = []) {
        // You can map route names to patterns manually or use FastRoute's dispatcher to resolve them
        // Example for /verify-lot-type/{lot-id} route:
        if ($routeName === 'verify-lot-type') {
            return '/verify-lot-type/' . urlencode($params['lot-id']);
        }
        return '#'; // Default fallback if route is not found
    }
}