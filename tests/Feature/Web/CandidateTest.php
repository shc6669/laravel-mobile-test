<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\RoleFactory;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;
use Vanguard\TCandidate;

class CandidateTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function create_candidate()
    {
        // Create Role
        $roleA = RoleFactory::withPermissions('candidate.create')->create();

        // Create User with Role
        $userA = UserFactory::role($roleA)->create();

        $candidate = $this->actingAs($userA)->post(route('candidate-management.store'), [
            'education_qualification_id'    => 4, 
            'education_country_id'          => 360, 
            'education_name'                => $this->faker->words(2),
            'applicant_name'                => $this->faker->applicant_name, 
            'birthday'                      => $this->faker->date(), 
            'experience'                    => 4, 
            'last_position'                 => 'Fullstack Developer',
            'applied_position'              => 'Senior PHP Developer',
            'email'                         => $this->faker->email,
            'phone'                         => $this->faker->phone,
            'resume'                        => null
        ]);

        $candidate->assertOk();
        $candidate->assertRedirect(route('candidate-management.index'));
    }
}
