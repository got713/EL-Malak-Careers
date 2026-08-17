<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    /**
     * Clear all Laravel caches (config, route, view, application) from the
     * admin panel, without needing SSH/Terminal access on the host.
     *
     * Protected by the 'auth' + 'role:admin' route middleware group, unlike
     * the old public/clear.php script which had no authentication at all.
     */
    public function clear()
    {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        // Some shared hosts (e.g. Hostinger) run PHP with OPcache enabled,
        // which can keep serving old compiled PHP after a deploy until it's
        // reset - clear it too if it's available.
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }

        return back()->with('success', __('Server cache cleared successfully.'));
    }
}
