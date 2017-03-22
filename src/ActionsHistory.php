<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class ActionsHistory extends Model
{
    protected $table = 'actions_history';

    protected $fillable = ['user_id', 'route', 'action'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getCreatedDateAttribute()
    {
        return Date::parse($this->created_at)->format('d-m-Y');
    }

    public function getCreatedTimeAttribute()
    {
        return Date::parse($this->created_at)->format('H:i:s');
    }
}
