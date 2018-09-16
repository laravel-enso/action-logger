<?php

use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\TestHelper\app\Traits\SignIn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\ActionLogger\app\Models\ActionLog;

class ActionLoggerTest extends TestCase
{
    use RefreshDatabase, SignIn;

    private $user;
    private $route;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->signIn($this->user = User::first());

        $this->route = 'administration.users.show';
    }

    /** @test */
    public function logs_action()
    {
        $this->get(route($this->route, $this->user->id, false))
            ->assertStatus(200);

        $actionLog = ActionLog::latest()->first();

        $this->assertEquals($actionLog->user_id, $this->user->id);
        $this->assertEquals($actionLog->route, $this->route);
    }
}
