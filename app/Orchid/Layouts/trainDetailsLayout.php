<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;


class trainDetailsLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'train_details';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id')->sort(),
            TD::make('class1'),
            TD::make('class2'),
            TD::make('class3'),
            TD::make('Actions')
                ->render(function ($target) {
                    return DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Edit'))
                        ->route('platform.traindetailsedit', $target)
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
