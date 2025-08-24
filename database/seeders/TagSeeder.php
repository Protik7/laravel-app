<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'id' => 1,
                'title' => 'tag1',
                'slug' => 'tag-1'
            ],
            [
                'id' => 2,
                'title' => 'tag2',
                'slug' => 'tag-2'
            ]
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate([
                'id' => $tag['id']
            ], $tag);
        }
    }
}
