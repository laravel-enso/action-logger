<?php

namespace LaravelEnso\ActionLogger\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelEnso\ActionLogger\Enums\Methods;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Tables\Traits\TableCache;
use LaravelEnso\Users\Models\User;

class ActionLog extends Model
{
    use TableCache;

    protected $guarded = [];

    protected function casts(): array
    {
        return ['method' => Methods::class];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'route', 'name');
    }
}
