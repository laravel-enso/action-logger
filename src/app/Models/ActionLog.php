<?php

namespace LaravelEnso\ActionLogger\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\Traits\FormattedTimestamps;

class ActionLog extends Model
{
    use FormattedTimestamps;

    protected $fillable = ['user_id', 'url', 'route', 'action'];

    public function user()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\User');
    }
}
