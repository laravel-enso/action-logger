<?php

namespace LaravelEnso\ActionLogger\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelEnso\ActionLogger\Models\ActionLog as Model;
use LaravelEnso\Tables\Contracts\Table;

class ActionLog implements Table
{
    private const TemplatePath = __DIR__.'/../Templates/actionLogs.json';

    public function query(): Builder
    {
        return Model::with(['user.avatar', 'user.person', 'permission'])
            ->select(['id', 'user_id', 'url', 'route', 'method', 'duration', 'created_at']);
    }

    public function templatePath(): string
    {
        return self::TemplatePath;
    }
}
