<?php

use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::all()->each(function($user){//para cada funcionario cria 10 todos //each é um loop
            $user->todos()->saveMany(
                factory(Todo::class, 10)->make() //usa-se o make porque quem salva no banco é o saveMany()
            )->each(function($todo){
                $todo->tasks()->saveMany(
                    factory(TodoTask::class)->make()
                );
            });
        });
    }
}
