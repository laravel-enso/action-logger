<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use LaravelEnso\TestHelper\app\Classes\TestHelper;

class ActionLoggerTest extends TestHelper
{
    use DatabaseMigrations;

    private $user;
    private $route;
    private $routeName;

    protected function setUp()
    {
        parent::setUp();

        $this->user  = User::first();
        $this->route = '/';
        $this->routeName = 'home';

        $this->signIn($this->user);
    }

    /** @test */
    public function logs_action()
    {
        $this->get($this->route)
            ->assertStatus(200);

        $actionLog = ActionLog::latest()->first();

        $this->assertEquals($actionLog->user_id, $this->user->id);
        $this->assertEquals('home', $actionLog->route, $this->routeName);
    }
}
