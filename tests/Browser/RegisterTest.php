<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
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
    public function testRegister()
    {
        $res = User::where('email', 'tester@laravel.com')->delete();
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/register')
                    ->type('email', 'tester@laravel.com')
                    ->type('name', 'tester')
                    ->type('password', 'tester@laravel.com')
                    ->type('password_confirmation', 'tester@laravel.com')
                    ->press('REGISTER')
                    ->pause(2000)
                    ->assertSee('Please check your email inbox to verify your email address.');
            }
        );
    }


    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = User::where('email', 'tester@laravel.com')->first();
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/login')
                    ->type('email', 'tester@laravel.com')
                    ->type('password', 'tester@laravel.com')
                    ->press('LOGIN')
                    ->pause(2000)
                    ->assertSee('Product');
            }
        );
    }
}
