<?php

namespace LaravelEnso\ActionLogger\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelEnso\ActionLogger\Models\ActionLog as Model;
use LaravelEnso\Helpers\Services\Obj;
use LaravelEnso\Tables\Contracts\CustomFilter;
use LaravelEnso\Tables\Contracts\Table;

class ActionLog implements Table, CustomFilter
{
    private const TemplatePath = __DIR__.'/../Templates/actionLogs.json';

    public function query(): Builder
    {
        return Model::with(['user.avatar', 'user.person', 'permission'])
            ->select(['id', 'user_id', 'url', 'route', 'method', 'duration', 'created_at']);
    }

    public function filterApplies(Obj $params): bool
    {
        return $params->filled('roleId');
    }

    public function filter(Builder $query, Obj $params): void
    {
        $query->whereHas('user', fn (Builder $user) => $user
            ->where('role_id', $params->get('roleId')));
    }

    public function templatePath(): string
    {
        return self::TemplatePath;
    }
}
