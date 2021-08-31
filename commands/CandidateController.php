<?php

namespace app\commands;

use app\models\Candidate;
use Faker\Factory;
use yii\console\Controller;

class CandidateController extends Controller
{
    public function actionIndex()
    {

        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 20; $i++){
            $model = new Candidate([
                'name' => $faker->name(),
                'city' => $faker->city,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'age' => $faker->numberBetween(18, 50),
            ]);
            $model->save(false);
        }
    }
}