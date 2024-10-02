<?php

namespace Tests\Unit;

use App\Models\UserActivityLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserActivityLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_log_user_activity()
    {
        $log = UserActivityLog::create([
            'user_id' => null,
            'activity' => 'login',
            'details' => 'User logged in',
        ]);

        $this->assertDatabaseHas('user_activity_logs', [
            'user_id' => null,
            'activity' => 'login',
        ]);
    }
}
