<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/login')
                    ->type('email', 'tester@laravel.com')
                    ->type('password', 'tester@laravel.com')
                    ->press('LOGIN')
                    ->pause(3000)
                    ->assertSee('Success');
            }
        );
    }
}
