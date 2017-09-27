<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use LaravelEnso\TestHelper\app\Traits\SignIn;
use Tests\TestCase;

class ActionLoggerTest extends TestCase
{
    use DatabaseMigrations, SignIn;

    private $user;
    private $route;
    private $routeName;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();
        $this->user = User::first();
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
