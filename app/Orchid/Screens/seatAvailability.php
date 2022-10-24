<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Orchid\Layouts\seatAvailabilityLayout;
use App\Models\seat_checks;
use Orchid\Support\Facades\Alert;


class seatAvailability extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'seat_checks' => seat_checks::filters()->defaultSort('id')->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Seats Booked';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            seatAvailabilityLayout::class 
        ];
    }

    public function remove(Request $request){
        $seat_checks = new seat_checks;
        $seat_checks->where('id',$request->id)->delete();
        Alert::message('you have deleted the seat checks of id: '.$request->id.'');
   }
}
