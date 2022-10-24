<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use App\Models\train_routes;
use App\Models\time_table;
use App\Models\train_details;
use App\Models\seat_checks;
use App\Models\prices;
use App\Orchid\Layouts\trainRoutesTable;
use App\Orchid\Layouts\timeTable;
use App\Orchid\Layouts\commonTable;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'train_routes' => train_routes::paginate(),
            'time_table' => time_table::paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Hello';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Welcome to Railway Reservation Dashboard';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            /*Link::make('Website')
                ->href('http://orchid.software')
                ->icon('globe-alt'),

            Link::make('Documentation')
                ->href('https://orchid.software/en/docs')
                ->icon('docs'),

            Link::make('GitHub')
                ->href('https://github.com/orchidsoftware/platform')
                ->icon('social-github'),*/
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            trainRoutesTable::class
        ];
    }
}
