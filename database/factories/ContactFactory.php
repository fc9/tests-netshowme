<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phone = '(11)' . $this->faker->numberBetween(1000, 99999) . '-' . $this->faker->numberBetween(1000, 9999);
        $filename = $this->faker->word() . '.pdf';
        $filesize = $this->faker->numberBetween(1, 500);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $phone,
            'message' => $this->faker->paragraph(),
            'attachment' => UploadedFile::fake()->create($filename, $filesize),
        ];
    }
}
