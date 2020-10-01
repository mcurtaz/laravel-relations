<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Employee;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Task::class, 100) -> create()
                                  -> each(function($tas){

                                    $emp = Employee::inRandomOrder() -> take(rand(2, 5)) -> get();

                                    $tas -> employees() -> attach($emp);
                                  });
    }
}
