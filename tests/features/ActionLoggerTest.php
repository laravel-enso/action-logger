<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\ActionLogger\Models\ActionLog;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ActionLoggerTest extends TestCase
{
    use RefreshDatabase;

    private const Route = 'administration.users.show';

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::first();
    }

    #[Test]
    public function logs_authenticated_request_with_route_url_method_and_duration()
    {
        $this->actingAs($this->user)
            ->get(route(self::Route, $this->user->id, false))
            ->assertStatus(200);

        $actionLog = ActionLog::latest()->first();

        $this->assertNotNull($actionLog);
        $this->assertEquals($this->user->id, $actionLog->user_id);
        $this->assertEquals(self::Route, $actionLog->route);
        $this->assertEquals(route(self::Route, $this->user->id, false), parse_url($actionLog->url, PHP_URL_PATH));
        $this->assertEquals('GET', $actionLog->method);
        $this->assertNotNull($actionLog->duration);
        $this->assertGreaterThanOrEqual(0, (float) $actionLog->duration);
        $this->assertLessThanOrEqual(999.999, (float) $actionLog->duration);
    }

    #[Test]
    public function does_not_log_guest_request()
    {
        $this->get(route(self::Route, $this->user->id, false))
            ->assertStatus(302);

        $this->assertDatabaseCount('action_logs', 0);
    }

    #[Test]
    public function resolves_permission_from_route_name()
    {
        $this->actingAs($this->user)
            ->get(route(self::Route, $this->user->id, false))
            ->assertStatus(200);

        $actionLog = ActionLog::latest()->first();
        $permission = Permission::whereName(self::Route)->first();

        $this->assertNotNull($actionLog);
        $this->assertNotNull($permission);
        $this->assertTrue($actionLog->permission->is($permission));
    }

    #[Test]
    public function exposes_action_logs_relation_on_user()
    {
        $this->actingAs($this->user)
            ->get(route(self::Route, $this->user->id, false))
            ->assertStatus(200);

        $actionLog = ActionLog::latest()->first();

        $this->assertNotNull($actionLog);
        $this->assertTrue($this->user->actionLogs->contains($actionLog));
        $this->assertTrue($this->user->actionLogs()->whereKey($actionLog->id)->exists());
    }
}
