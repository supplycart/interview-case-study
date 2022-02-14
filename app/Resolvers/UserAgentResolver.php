<?php
namespace App\Resolvers;

use Illuminate\Support\Facades\Request;

class UserAgentResolver implements \OwenIt\Auditing\Contracts\UserAgentResolver
{
    /**
     * {@inheritdoc}
     */
    public static function resolve()
    {
        // Default to "N/A" if the User Agent isn't available
        return Request::header('User-Agent', 'N/A');
    }
}