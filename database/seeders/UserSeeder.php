<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        $city=City::all("id")->map(function($id){return $id->id;});

//        dd($city->random());
        foreach (range(1,10) as $i){
            \DB::table("users")->insert([
                "first_n"=>$faker->firstName(),
                "last_n"=>$faker->lastName(),
                "street"=>$faker->streetAddress(),
                "email"=>$faker->email(),
                "picture"=>"sdf",
                "phone"=>$faker->e164PhoneNumber(),
                "password"=>md5("sifra".$i),
                "city_id"=>$city->random(),
                "role_id"=>1
            ]);
        }
    }
}
