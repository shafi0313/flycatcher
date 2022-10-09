<?php

namespace App\Observers;

use App\Http\Requests\Admin\RiderRequest;
use App\Models\Admin\Rider;
use App\Models\AssignArea;
use App\Repository\Interfaces\AssignAreaInterface;
use Illuminate\Support\Facades\Log;

class RiderObserver
{
    protected $assignAreaRepo;
    public function __construct(AssignAreaInterface $assignArea)
    {
        $this->assignAreaRepo = $assignArea;
    }

    /**
     * Handle the Rider "created" event.
     *
     * @param Rider $rider
     * @param RiderRequest $request
     * @return void
     */
    public function created(Rider $rider)
    {
//        foreach (request()->area_id as $area){
//            $this->assignAreaRepo->createAssignArea([
//                'area_id'=>$area,
//                'assignable_id'=>$rider->id,
//                'assignable_type'=>Rider::class,
//            ]);
//        }
    }

    /**
     * Handle the Rider "updated" event.
     *
     * @param Rider $rider
     * @return void
     */
    public function updated(Rider $rider)
    {
    }

    /**
     * Handle the Rider "deleted" event.
     *
     * @param  \App\Models\Rider  $rider
     * @return void
     */
    public function deleted(Rider $rider)
    {
        //
    }

    /**
     * Handle the Rider "restored" event.
     *
     * @param  \App\Models\Rider  $rider
     * @return void
     */
    public function restored(Rider $rider)
    {
        //
    }

    /**
     * Handle the Rider "force deleted" event.
     *
     * @param  \App\Models\Rider  $rider
     * @return void
     */
    public function forceDeleted(Rider $rider)
    {
        //
    }
}
