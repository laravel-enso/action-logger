<?php

namespace LaravelEnso\ActionLogger\App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActionsHistory extends Model
{
    protected $table = 'actions_history';

    protected $fillable = ['user_id', 'route', 'action'];

    public function user()
    {
        return $this->belongsTo('LaravelEnso\Core\App\Models\User');
    }

    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    public function getCreatedTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i:s');
    }
}
