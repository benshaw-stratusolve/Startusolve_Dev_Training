<?php

use App\Models\User;

it('registers a user', function () {
    /** @var \Tests\TestCase $this */
    // when i visit the registration page
    visit('/register') //->debug(); //use debug to make sure this is correct
        ->fill('name', 'Mane Doe')    
        ->fill('email', 'jane@gmail.com')
        ->fill('password', 'password')
        ->fill('Confirm Password', 'password')
        ->press('Create Account')
        // and i fill out and submit the form
        ->assertPathIs('/ideas'); //and i should be on the ideas page
    //then i should have an account 
    /** @var \Tests\TestCase $this */
    expect(User::count())->toBe(1);
    //and i should be signed in
    $this->assertAuthenticated();
    
});