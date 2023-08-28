<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Project;
use App\Models\Admin\Type;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $typeIds = Type::all()->pluck('id');
        for($i=0; $i < 50; $i++){
            $newProject = new Project();
            $newProject->type_id = $faker->randomElement($typeIds);
            $newProject->title = $faker->words(rand(1, 10), true);
            $newProject->description = $faker->paragraph(10, true);
            $newProject->date = $faker->date();
            $newProject->image = $faker->imageUrl(480, 360, 'post', true, 'posts', true, 'png');
            $newProject->slug = Str::of($newProject->title)->slug('-');
            $newProject->save();
            $newProject->slug = Str::of("$newProject->id " . $newProject->title)->slug('-');
            $newProject->save();
        }
    }
}
