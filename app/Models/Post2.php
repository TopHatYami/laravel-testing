<?php
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post{

  public $title;
  public $date;
  public $excerpt;
  public $body;
  public $slug;

  public function __construct($title, $excerpt, $date, $body, $slug){
    //Set up the information of the blog post when an instance is called
    $this->title = $title;
    $this->date = $date;
    $this->excerpt = $excerpt;
    $this->body = $body;
    $this->slug = $slug;
  }

  public static function find($slug){
    //Grab the first item in the object that matches our slug
    return static::all()->firstWhere('slug',$slug);
  }

  public static function findOrFail($slug){
    //Grab the first item in the object that matches our slug
    $post = static::find($slug);

    if(!$post){ //throw a 404 if it doesn't find anything
      throw new ModelNotFoundException();
    }

    return $post;
  }

  public static function all(){
    //Return a list of all the files in the directory
    return cache()->rememberForever('posts.all',function(){
      return collect(File::files(resource_path("posts/")))
      ->map(function($file){
        return YamlFrontMatter::parseFile($file);
      })
      ->map(function($doc){
        return new Post(
          $doc->title,
          $doc->excerpt,
          $doc->date,
          $doc->body(),
          $doc->slug
        );
      })
      ->sortByDesc('date');
    });
  }

}
