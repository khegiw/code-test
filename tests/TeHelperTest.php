<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\TeHelper;
use Carbon\Carbon;

class TeHelperTest extends TestCase
{
    /**
     * basic test for willExpireAt method on App\Helpers\TeHelper class.
     *
     * @return void
     */
    public function testWillExpireAtMethod()
    {
        //
        // created at value
        $created_at = Carbon::now();
        // due time <= 90 hour from now  condition
        $due_time = Carbon::now()->addHours(90);
        // call willExpiredAt method
        $expired = TeHelper::willExpireAt($due_time->toDateTimeString(), $created_at->toDateTimeString());
        //test the return value is equal with due time
        $this->assertEquals($expired,$due_time->toDateTimeString());

        //
        // due time is <=24 hour from now  condition
        $due_time = Carbon::now()->addHours(23);
        // call willExpiredAt method
        $expired = TeHelper::willExpireAt($due_time->toDateTimeString(), $created_at->toDateTimeString());
        //helpers will the return value is equal 90 minutes from now
        $this->assertEquals($expired,$created_at->addMinutes(90)->toDateTimeString());

        //
        // due time is >24 hour from now  condition
        $due_time = Carbon::now()->addHours(25);
        // call willExpiredAt method
        $expired = TeHelper::willExpireAt($due_time->toDateTimeString(), $created_at->toDateTimeString());
        //helpers will the return value is equal 16 hours from now
        $this->assertEquals($expired,$created_at->addHours(16)->toDateTimeString());

        //
        // due time is <=70 hour from now condition
        $due_time = Carbon::now()->addHours(70);
        // call willExpiredAt method
        $expired = TeHelper::willExpireAt($due_time->toDateTimeString(), $created_at->toDateTimeString());
        //helpers will the return value is equal 16 hours from now
        $this->assertEquals($expired,$created_at->addHours(16)->toDateTimeString());
    }
}
