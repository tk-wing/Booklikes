<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::firstOrCreate(['name' => '文学・小説']);
        Category::firstOrCreate(['name' => '社会・ビジネス']);
        Category::firstOrCreate(['name' => '旅行・地図']);
        Category::firstOrCreate(['name' => '趣味']);
        Category::firstOrCreate(['name' => '実用・教育']);
        Category::firstOrCreate(['name' => 'アート・教養・エンタメ']);
        Category::firstOrCreate(['name' => '事典・図鑑・語学・辞書']);
        Category::firstOrCreate(['name' => 'こども']);
        Category::firstOrCreate(['name' => 'その他']);
    }
}
