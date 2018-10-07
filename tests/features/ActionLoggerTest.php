<?php

use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\ActionLogger\app\Models\ActionLog;

class ActionLoggerTest extends TestCase
{
    use RefreshDatabase;

    private const Route = 'administration.users.show';

    private $user;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs($this->user = User::first());
    }

    /** @test */
    public function logs_action()
    {
        $this->get(route(self::Route, $this->user->id, false))
            ->assertStatus(200);

        $actionLog = ActionLog::latest()->first();

        $this->assertEquals($actionLog->user_id, $this->user->id);
        $this->assertEquals($actionLog->route, self::Route);
    }
}
