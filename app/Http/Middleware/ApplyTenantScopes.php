<?php

namespace App\Http\Middleware;

use App\Models\Department;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
 
class ApplyTenantScopes
{
    public function handle(Request $request, Closure $next)
    {

        Department::addGlobalScope(
            fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );
        
        return $next($request);
    }
}
