<?php

namespace App\Traits;

use App\Scopes\CurrentTeamScope;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

trait CurrentTeam
{
    public static function bootCurrentTeam(): void
    {
        static::creating(static function ($model) {
            if (empty($model->team_id)) {
                if (Auth::check() && Filament::getTenant()) {
                    $model->team_id = Filament::getTenant()->id;
                } else {
                    Notification::make()
                        ->danger()
                        ->title('Oops! Unable to Assign Team')
                        ->body('We encountered an issue while creating the record. Please ensure you are logged in and have a valid team associated with your account.')
                        ->persistent()
                        ->send();
                }
            }
        });

        static::addGlobalScope(new CurrentTeamScope);
    }
}
