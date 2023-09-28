<?php

namespace App\Models;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Posts
{
    public $name;
    public $title;
    public $date;
    public $excerpt;
    public $body;

    public function __construct($name, $title,$excerpt,$date, $body)
    {
        $this->name = $name;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }
    public static function all(){
        return cache()->rememberForever('Postall',function (){
            $files = File::files(resource_path('posts'));
            return collect($files)->map(function ($file){
                $document = YamlFrontMatter::parseFile($file);
                return new Posts(
                    $document->name,
                    $document->title,
                    $document->date,
                    $document->excerpt,
                    $document->body()
                );
            })->sortByDesc('date');
        });

    }
    public static function find($name){

        return static::all()->firstWhere('name',$name);

    }
    public static function findOrFail($name){
        $post = static::find($name);
        if(! $post){
            throw new ModelNotFoundException();
        }

        return $post;
    }

}
