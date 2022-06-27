<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkimizda','Koriyer','Vizyonumuz','Misyonumuz'];
        $count=0;
        foreach ($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>Str::slug($page),
                'image'=>'https://assets.entrepreneur.com/content/3x2/2000/20160602195129-businessman-writing-planning-working-strategy-office-focus-formal-workplace-message.jpeg?crop=16:9',
                'content'=>'widgetsmith lets you personalize your$pagewidgetsmith lets you personalize your$pagewidgetsmith lets you personalize your$page',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
