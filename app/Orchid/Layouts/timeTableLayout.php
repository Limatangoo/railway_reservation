<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;

class timeTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'time_table';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('route_id')->sort(),
            TD::make('city1'),
            TD::make('city2'),
            TD::make('city3'),
            TD::make('city4'),
            TD::make('city5'),
            TD::make('city6'),
            TD::make('city7'),
            TD::make('city8'),
            TD::make('city9'),
            TD::make('city10'),
            TD::make('Actions')
                ->render(function ($target) {
                    return DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Edit'))
                        ->route('platform.timetableedit', $target)
                        ->icon('pencil'),

                        Button::make('Delete')
                        ->icon('trash')
                        ->parameters([
                            'id' => ($target->id)
                        ])
                        ->method('remove')
                    ]);
                }),

        ];
    }
}
