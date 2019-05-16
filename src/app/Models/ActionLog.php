<?php

namespace LaravelEnso\ActionLogger\app\Models;

use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Permissions\app\Models\Permission;

class ActionLog extends Model
{
    protected $fillable = ['user_id', 'url', 'route', 'method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'route', 'name');
    }
}
