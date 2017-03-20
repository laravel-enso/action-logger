<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

/**
 * App\ActionsHistory.
 *
 * @property int $id
 * @property int $user_id
 * @property string $route
 * @property string $action
 * @property \Carbon\Carbon $created_at
 * @property-read \App\User $user
 * @property-read mixed $created_date
 * @property-read mixed $created_time
 *
 * @method static \Illuminate\Database\Query\Builder|\App\ActionsHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActionsHistory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActionsHistory whereRoute($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActionsHistory whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActionsHistory whereCreatedAt($value)
 * @mixin \Eloquent
 */
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
