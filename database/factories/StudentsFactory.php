<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname'  => $this->faker->lastName(),
            'birthdate' => $this->faker->date('Y-m-d'),
            'sex'       => array_rand(['MALE' => 'MALE', 'FEMALE' => 'FEMALE']),
            'address'   => $this->faker->city(),
            'year'      => rand(1, 4),
            'course'    => array_rand([
                'BSCS'  => 'BSCS',
                'BSIT'  => 'BSIT',
                'HRT'   => 'HRT',
                'BSA'   => 'BSA'
            ]),
            'section'   => $this->faker->randomElement(['A','B','C','D'])
        ];
    }
}
