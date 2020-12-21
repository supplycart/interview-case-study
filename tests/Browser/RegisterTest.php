<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {

       $res =  User::where('email','tester@laravel.com')->delete();
//       dd($res);
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/register')
                    ->type('email', 'tester@laravel.com')
                    ->type('name', 'tester')
                    ->type('password', 'tester@laravel.com')
                    ->type('password_confirmation', 'tester@laravel.com')
                    ->press('REGISTER')
                    ->pause(3000)
                    ->assertSee('Please check your email inbox to verify your email address.');
            }
        );
    }
}
