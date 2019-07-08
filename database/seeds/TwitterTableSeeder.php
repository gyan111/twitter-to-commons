<?php

use Illuminate\Database\Seeder;

class TwitterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */    public function run()
    {
    	DB::table('twitters')->delete();

    	$twitterHandles = [["id"=>"1","handle" => "CMO_Odisha", "name" => "CMO Odisha", "template" => "{{GoO-donation}}", "category" => "Content donated by Government of Odisha", "author" => "[[:en:Government of Odisha|Government of Odisha]]"],
    					   ["id"=>"2","handle" => "Naveen_Odisha", "name" => "Naveen Patnaik", "template" => "{{GoO-donation}}", "category" => "Content donated by Government of Odisha", "author" => "[[:en:Government of Odisha|Government of Odisha]]"],
    					   ["id"=>"3","handle" => "ipr_odisha", "name" => "I & PR Department, Odisha", "template" => "{{GoO-donation}}", "category" => "Content donated by Government of Odisha", "author" => "[[:en:Government of Odisha|Government of Odisha]]"],
    					   ["id"=>"4","handle" => "ctodisha", "name" => "Commerce & Transport, Odisha", "template" => "{{GoO-donation}}", "category" => "Content donated by Government of Odisha", "author" => "[[:en:Government of Odisha|Government of Odisha]]"]];
    	foreach ($twitterHandles as $twitterHandle) {
    		DB::table('twitters')->insert($twitterHandle);
    	}
        
    }
}
