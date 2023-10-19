<?php

namespace App\Scopes;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\{Builder, Model, Scope};
use Illuminate\Support\Facades\Auth;

class CurrentTeamScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (Auth::check() && Filament::getTenant()) {
            $builder->whereBelongsTo(Filament::getTenant());
        }
    }
}
