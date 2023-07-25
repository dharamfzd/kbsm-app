<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->phoneNumber,
            'class' => $this->faker->randomElement(['BSC', 'MSC', 'BCA', 'MCA', 'BTECH', 'MTECH']),
            'father_name' => $this->faker->name('male'),
            'mother_name' => $this->faker->name('female'),
        ];
    }
}
