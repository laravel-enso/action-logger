<?php

namespace LaravelEnso\ActionLogger\App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Permissions\App\Models\Permission;

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
