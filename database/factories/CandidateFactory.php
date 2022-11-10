<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Vanguard\TCandidate;

class CandidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TCandidate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
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
        ];
    }
}
