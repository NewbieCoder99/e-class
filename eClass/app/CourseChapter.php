<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseChapter extends Model
{
	use HasTranslations;
    
    public $translatable = ['chapter_name'];

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
      $attributes = parent::toArray();
      
      foreach ($this->getTranslatableAttributes() as $name) {
          $attributes[$name] = $this->getTranslation($name, app()->getLocale());
      }
      
      return $attributes;
    }

    protected $table = 'course_chapters';

    protected $fillable = [ 'course_id', 'chapter_name', 'short_number', 'status', 'file' ];

    public function courseclass()
    {
        return $this->hasMany('App\CourseClass','coursechapter_id');
    }

    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id','id');
    }
}
