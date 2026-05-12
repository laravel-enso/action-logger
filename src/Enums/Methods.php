<?php

namespace LaravelEnso\ActionLogger\Enums;

use Illuminate\Http\Request;
use LaravelEnso\Enums\Contracts\Frontend;
use LaravelEnso\Enums\Contracts\Mappable;
use LaravelEnso\Enums\Contracts\Select;
use LaravelEnso\Enums\Traits\Select as Options;

enum Methods: int implements Frontend, Mappable, Select
{
    use Options;

    case Get = 1;
    case Post = 2;
    case Put = 3;
    case Patch = 4;
    case Delete = 5;
    case Options = 6;
    case Head = 7;

    public static function fromRequest(Request $request): self
    {
        return match ($request->method()) {
            'GET' => self::Get,
            'POST' => self::Post,
            'PUT' => self::Put,
            'PATCH' => self::Patch,
            'DELETE' => self::Delete,
            'OPTIONS' => self::Options,
            'HEAD' => self::Head,
        };
    }

    public function map(): string
    {
        return match ($this) {
            self::Get => 'GET',
            self::Post => 'POST',
            self::Put => 'PUT',
            self::Patch => 'PATCH',
            self::Delete => 'DELETE',
            self::Options => 'OPTIONS',
            self::Head => 'HEAD',
        };
    }

    public static function registerBy(): string
    {
        return 'actionLogMethods';
    }
}
