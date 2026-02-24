<?php

namespace App\Providers;

use App\Models\DepartmentSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ── Dynamic admin layout ──
        // When a super admin opens shared admin views (news, staff, events, etc.),
        // they see the super-admin layout (red theme). Regular admins see the admin layout (green).
        View::composer('admin.*', function ($view) {
            if (auth()->check() && auth()->user()->isSuperAdmin()) {
                $view->with('adminLayout', 'layouts.super-admin');
            } else {
                $view->with('adminLayout', 'layouts.admin');
            }
        });

        // Share branding colors with every view so layouts can inject them as CSS variables
        View::composer('*', function ($view) {
            static $colors = null;

            if ($colors === null) {
                try {
                    if (Schema::hasTable('department_settings')) {
                        $settings = DepartmentSetting::where('group', 'branding')->pluck('value', 'key');
                        $colors = [
                            'primary'   => $settings->get('color_primary', config('university.primary_color', '#16a34a')),
                            'secondary' => $settings->get('color_secondary', config('university.secondary_color', '#15803d')),
                            'accent'    => $settings->get('color_accent', config('university.accent_color', '#22c55e')),
                        ];
                    } else {
                        $colors = [
                            'primary'   => config('university.primary_color', '#16a34a'),
                            'secondary' => config('university.secondary_color', '#15803d'),
                            'accent'    => config('university.accent_color', '#22c55e'),
                        ];
                    }
                } catch (\Throwable $e) {
                    $colors = [
                        'primary'   => config('university.primary_color', '#16a34a'),
                        'secondary' => config('university.secondary_color', '#15803d'),
                        'accent'    => config('university.accent_color', '#22c55e'),
                    ];
                }
            }

            $view->with('brandColors', $colors);
        });
    }
}
