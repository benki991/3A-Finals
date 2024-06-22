<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id'    => rand(1,2),
            'subject_code'  => 'IT' . rand(1000,2000),
            'name'          => array_rand(['SYSTEM ADMIN' => 'SYSTEM ADMIN', 'DBMS' => 'DBMS']),
            'description'   => $this->faker->paragraph(2),
            'instructor'    => $this->faker->name(),
            'schedule'      => array_rand([
                'MW 1pm-3pm' => 'MW 1pm-3pm',
                'MW 3pm-5pm' => 'MW 3pm-5pm',
            ]),
            'prelims'       => mt_rand(1.0*10, 5.0*10)/10,
            'midterms'      => mt_rand(1.0*10, 5.0*10)/10,
            'prefinals'     => mt_rand(1.0*10, 5.0*10)/10,
            'finals'        => mt_rand(1.0*10, 5.0*10)/10,
            'average'       => mt_rand(1.0*10, 5.0*10)/10,
            'date_taken'    => $this->faker->date('Y-m-d')
        ];
    }
}
