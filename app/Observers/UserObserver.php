<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    
     public function created(User $user): void
     {
         dd($user);
         // Ajouter toutes les applications associées à la fonction de l'utilisateur
         $fonction = $user->fonction()->with('applications')->get();
         $applications = $fonction->pluck('applications')->flatten()->unique('id');
         $user->applications()->sync($applications->pluck('id'));
     }
     
     /**
      * Handle the User "updated" event.
      */
     public function updated(User $user): void
     {
         // Ajouter les nouvelles applications associées aux fonctions de l'utilisateur
         $fonction = $user->fonction()->with('applications')->get();
         $applications = $fonction->pluck('applications')->flatten()->unique('id');
         $user->applications()->sync($applications->pluck('id'));
     
         // Supprimer les applications qui ne sont plus associées aux fonctions de l'utilisateur
         $userApplications = $user->applications()->pluck('id')->toArray();
         $removedApplications = array_diff($userApplications, $applications->pluck('id')->toArray());
         if (!empty($removedApplications)) {
             $user->applications()->detach($removedApplications);
         }
     }
     
    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $user->applications()->sync([]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
