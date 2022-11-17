<?php

use App\User;
use App\Todo; 
use App\TodoTask; 
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Para cada usuário cria 10 seeds de to-dos, e para cada to-dos ele cria 10 to-dos-tasks
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user){                //para cada funcionario cria 10 todos //each é um loop
            $user->todos()->saveMany(factory(Todo::class, 10)->make())->each(function($todo){
                $todo->tasks()->saveMany(factory(TodoTask::class, 10)->make());//usa-se o make porque quem salva no banco é o saveMany()
            });
        });
    }
}
