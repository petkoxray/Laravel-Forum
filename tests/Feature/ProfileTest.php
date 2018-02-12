<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_has_a_profile()
    {
        $user = create('App\Models\User');

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    function profiles_display_all_threads_created_by_the_associated_user()
    {
        $user = create('App\Models\User');

        $thread = create('App\Models\Thread', ['user_id' => $user->id]);

        $this->get("/profiles/{$user->name}")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}