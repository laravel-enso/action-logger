<?php

namespace LaravelEnso\ActionLogger\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Permissions\Models\Permission;

class ActionLog extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'route', 'name');
    }
}
