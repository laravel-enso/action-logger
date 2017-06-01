<?php

namespace LaravelEnso\ActionLogger\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActionLog extends Model
{
    use DatabaseMigrations;

    protected $fillable = ['user_id', 'url', 'route', 'action'];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }

    public function getCreatedTimeAttribute()
    {
        return $this->created_at->format('H:i:s');
    }
}
