<?php

use App\Course;
use App\Categories;
use App\Instructor;
use App\SubCategory;
use App\ChildCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $category = Categories::create([
                'title' => 'Categories 1',
                'icon' => 'fa-address-book',
                'slug' => 'categories-1',
                'featured' => '1',
                'status' => '1'
            ]);

            $subCategory = SubCategory::create([
                'category_id' => $category->id,
                'title' => 'sub Categories 1',
                'icon' => 'fa-address-book',
                'slug' => 'sub-categories-1',
                'status' => '1',
            ]);

            $childCategory = ChildCategory::create([
                'category_id' => $category->id,
                'subcategory_id' => $subCategory->id,
                'title' => 'child categories 1',
                'icon' => 'fa-address-book',
                'slug' => 'child-categories-1',
                'status' => '1'
            ]);

            $instructor = Instructor::all();

            foreach ($instructor as $key => $value) {
                Course::create([
                    'user_id' => $value->id,
                    'category_id' => $category->id,
                    'subcategory_id' => $subCategory->id,
                    'childcategory_id' => $childCategory->id,
                    'language_id' => 'en',
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollaback();
            dd($th->getMessage());
        }
    }
}
