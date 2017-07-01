<?php

namespace LaravelEnso\ActionLogger\app\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class ActionLog extends Model
{
    protected $fillable = ['user_id', 'url', 'route', 'action'];

    public function user()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\User');
    }

    public function permission()
    {
        return $this->hasOne('LaravelEnso\PermissionManager\app\Models\Permission', 'name', 'route');
    }

    public function getCreatedAtAttribute($value)
    {
        return Date::parse($value)->diffForHumans();
    }
}
