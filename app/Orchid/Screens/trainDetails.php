<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Orchid\Layouts\trainDetailsLayout;
use App\Models\train_details;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Alert;

class trainDetails extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'train_details' => train_details::filters()->defaultSort('id')->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Train Details';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('add new train details')
                ->route('platform.traindetailsadd')
                ->icon('plus'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            trainDetailsLayout::class 
        ];
    }
    public function remove(Request $request){
        $train_details = new train_details;
        $train_details->where('id',$request->id)->delete();
        Alert::message('you have deleted route id: '.$request->id.'');
   }
}
