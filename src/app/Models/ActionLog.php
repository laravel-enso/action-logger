<?php

namespace LaravelEnso\ActionLogger\app\Models;

use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\Multitenancy\app\Traits\SystemConnection;

class ActionLog extends Model
{
    use SystemConnection;

    protected $fillable = ['user_id', 'url', 'route', 'method'];

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('app.env') === 'testing'
            ? 'sqlite'
            : 'system';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'route', 'name');
    }
}
