<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Career extends Model
{
    use HasTranslations;
    
    public $translatable = ['one_heading', 'one_text', 'one_btntxt', 'three_heading', 'three_btntxt', 'five_heading', 'five_text', 'five_detail', 'five_textone', 'five_texttwo', 'five_textthree', 'five_textfour', 'five_textfive', 'five_textsix', 'five_textseven', 'five_texteight', 'five_textnine', 'five_textten', 'five_dtlone', 'five_dtltwo', 'five_dtlthree', 'five_dtlfour', 'five_dtlfive', 'five_dtlsix', 'five_dtlseven', 'five_dtleight', 'five_dtlnine', 'five_dtlten', 'six_heading', 'six_text', 'six_topic_one', 'six_topic_two', 'six_topic_three', 'six_topic_four', 'six_topic_five', 'six_topic_six', ];

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

    protected $table = 'careers';  

    protected $fillable = [ 

        'one_enable', 'one_heading', 'one_text', 'one_btntxt', 'one_video',

        'two_enable', 'three_enable', 'three_bg_image', 'three_video', 'three_heading', 'three_btntxt',

        'four_enable', 'four_img_one', 'four_img_two', 'four_img_three', 'four_img_four', 'four_img_five', 'four_img_six', 'four_img_seven', 'four_img_eight', 'four_img_nine', 

        'five_enable', 'five_heading', 'five_text', 'five_icon', 'five_detail', 'five_textone', 'five_texttwo', 'five_textthree', 'five_textfour', 'five_textfive', 'five_textsix', 'five_textseven', 'five_texteight', 'five_textnine', 'five_textten', 'five_dtlone', 'five_dtltwo', 'five_dtlthree', 'five_dtlfour', 'five_dtlfive', 'five_dtlsix', 'five_dtlseven', 'five_dtleight', 'five_dtlnine', 'five_dtlten',

        'six_enable', 'six_heading', 'six_text', 'six_topic_one', 'six_topic_two', 'six_topic_three', 'six_topic_four', 'six_topic_five', 'six_topic_six', 

    ];
}
