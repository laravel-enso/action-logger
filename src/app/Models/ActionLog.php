<?php

namespace LaravelEnso\ActionLogger\app\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\PermissionManager\app\Models\Permission;

class ActionLog extends Model
{
    protected $fillable = ['user_id', 'url', 'route', 'action'];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model', 'user_id'));
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'route', 'name');
    }

    public static function store(Request $request)
    {
        self::create([
            'user_id' => $request->user()->id,
            'url' => $request->url(),
            'route' => $request->route()->getName(),
            'action' => $request->method(),
        ]);
    }
}
