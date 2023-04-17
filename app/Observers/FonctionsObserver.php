<?php

namespace App\Observers;

use App\Models\Fonctions;

class FonctionsObserver
{
    /**
     * Handle the Fonctions "created" event.
     */
    public function created(Fonctions $fonctions): void
    {
       
           
    }

    /**
     * Handle the Fonctions "updated" event.
     */
    public function updated(Fonctions $fonctions): void
    {

    
    }

    /**
     * Handle the Fonctions "deleted" event.
     */
    public function deleted(Fonctions $fonctions): void
    {
        //
    }

    /**
     * Handle the Fonctions "restored" event.
     */
    public function restored(Fonctions $fonctions): void
    {
        //
    }

    /**
     * Handle the Fonctions "force deleted" event.
     */
    public function forceDeleted(Fonctions $fonctions): void
    {
        //
    }
}
