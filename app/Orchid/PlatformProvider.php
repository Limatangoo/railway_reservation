<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;
use App\Models\train_routes;
use Illuminate\Support\Facades\DB;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Train Routes')
                ->icon('directions')
                ->route('platform.trainroutes')
                ->title('Navigation')
                ->badge(function () {
                    $findRouteId = DB::select('select id FROM train_routes');
                    $trainRouteCount=count($findRouteId);
                    return $trainRouteCount;
                }),

            Menu::make('Time Table')
                ->icon('clock')
                ->route('platform.timetable'),

            Menu::make('Seat Availability')
                ->icon('event')
                ->route('platform.seatavailability'),

            Menu::make('Prices Table')
                ->icon('dollar')
                ->route('platform.pricestable'),

            Menu::make('Train Details')
            ->icon('task')
            ->route('platform.traindetails'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
