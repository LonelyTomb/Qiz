<?php

use App\questionAnswer;
use Illuminate\Database\Seeder;

class questionAnswerSeed extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table((new questionAnswer)->getTable())->truncate();

		questionAnswer::insert([
			[
				'id' => 1,
				'question_id' => '1',
				'answer' => 'An industry is a group of firm or businesses that produce similar or identical kind of goods or
services.',
				'marks' => 5,
				'keywords' => "firm,business,produce,goods,services"
			],
		]);
		questionAnswer::insert([
			[
				'id' => 2,
				'question_id' => '2',
				'answer' => 'Fixed costs, Variable costs, Total costs, Average costs, Marginal costs',
				'marks' => 5,
				'keywords' => "Fixed,Total,Average,Marginal"
			],
		]);
		questionAnswer::insert([
			[
				'id' => 3,
				'question_id' => '3',
				'answer' => 'This is an economic situation whereby there is a persistent or consistent rise in the general price level of goods and services',
				'marks' => 5,
				'keywords' => "economic,situation,price,goods,rise,services"
			],
		]);questionAnswer::insert([
			[
				'id' => 4,
				'question_id' => '4',
				'answer' => 'Demand-pull inflation is a type of inflation that occurs when demand for goods and services increase without a corresponding increase in the supply of goods and services',
				'marks' => 5,
				'keywords' => "inflation,increase,supply,demand"
			],
		]);
	}
}
