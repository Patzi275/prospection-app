<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prospection>
 */
class ProspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $times = $this->generateTimes();
        $products = array('table', 'chaise', 'ordinateur', 'ecran');
        $observations = array(
            null, 
            $this->faker->text($maxNbChars = 200), 
            $this->faker->sentence()
        );

        $array = [
            'agent_name' => $this->faker->name,
            'client_name' => $this->faker->name,
            'address' => $this->faker->address,
            'date' => $this->faker->dateTimeBetween('2020-01-01', date('Y-m-d'))->format('Y-m-d'),
            'start_time' => $times['start_time'],
            'end_time' => $times['end_time'],
            'duration' => $times['duration'],
            'product' => $products[array_rand($products)],
            'observation' => $observations[array_rand($observations)],
            'is_sold' => rand(0, 1)
        ];

        return $array;
    }

    function generateTimes() {
        $start_time = Carbon::createFromTime(rand(0, 22), rand(0, 59))->format('H:i');
        $end_time = Carbon::parse($start_time)
            ->addHours(rand(0, 2))
            ->addMinutes(rand(0, 59))
            ->format('H:i');
        
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);
        $duration = $end->diff($start)->format('%H:%I');

        return compact('start_time', 'end_time', 'duration');
    }

}
