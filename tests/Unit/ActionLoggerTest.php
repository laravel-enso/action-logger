<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use Tests\TestCase;

class ActionLoggerTest extends TestCase
{
    use DatabaseMigrations;

    private $user;
    private $route;
    private $response;

    protected function setUp()
    {
        parent::setUp();

        $this->user = User::first();
        $this->route = '/';
        $this->response = null;
    }

    /** @test */
    public function logs_action()
    {
        // Arrange
        // authenticate as first user
        $this->be($this->user);

        // Act
        // access the home route.
        $this->response = $this->get($this->route);

        // Assert
        // the route was accessed
        // the route was logged
        $this->response->assertStatus(200);
        $this->assertTrue($this->latestActionLogIsCorrect());
    }

    private function latestActionLogIsCorrect()
    {
        $actionLog = ActionLog::latest()->first();

        return $actionLog->user_id == $this->user->id
            && $actionLog->route == 'home';
    }
}
