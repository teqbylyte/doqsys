<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    #[ArrayShape(['error' => "string"])]
    protected function getExceptionMsg(\Exception $exception): array
    {
        $msg = $exception->getMessage();

        if (env('APP_ENV') == 'production') {
            $msg = 'An error occurred';
            Log::error($exception->getMessage() . "\n");
        }

        return ['error' => $msg];
    }

    /*
     * Get the breadcrumbs with the home directory
     */
    protected function getBreadcrumbs(array $breadcrumbs_array = null, bool $home_link = true): array
    {
        $breadcrumbs = [
            [
                'link' => $home_link ? route('home') : null,
                'name' => "Home",
                'icon' => 'home'
            ]
        ];

        if (!is_null($breadcrumbs_array)) {
            foreach ($breadcrumbs_array as $b) {
                $breadcrumbs[] =  $b;
            }
        }

        return $breadcrumbs;
    }
}
