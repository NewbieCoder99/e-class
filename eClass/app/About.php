<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
	  use HasTranslations;
    
    public $translatable = ['one_heading', 'one_text', 'two_heading', 'two_text', 'two_txtone', 'two_txttwo', 'two_txtthree', 'two_txtfour', 'two_imagetext',  'three_heading', 'three_text', 'three_txtone', 'three_txttwo', 'three_txtthree', 'three_txtfour', 'three_txtfive', 'three_txtsix', 'four_heading', 'four_text', 'four_btntext',  'four_txtone', 'four_txttwo', 'five_heading', 'five_text', 'five_btntext', 'six_heading', 'six_txtone', 'six_txttwo', 'six_txtthree', 'six_deatilone', 'six_deatiltwo', 'six_deatilthree', 'text_one', 'text_two', 'text_three' ];

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

    protected $table = 'abouts'; 

    protected $fillable = [

	    'one_enable', 'one_heading', 'one_image', 'one_text',

	    'two_enable', 'two_heading', 'two_text', 'two_imageone', 'two_imagetwo', 'two_imagethree', 'two_imagefour', 'two_txtone', 'two_txttwo', 'two_txtthree', 'two_txtfour', 'two_imagetext',

	    'three_enable', 'three_heading', 'three_text', 'three_countone', 'three_counttwo', 
	    'three_countthree', 'three_countfour', 'three_countfive', 'three_countsix', 'three_txtone', 'three_txttwo', 'three_txtthree', 'three_txtfour', 'three_txtfive', 'three_txtsix',

	    'four_enable', 'four_heading', 'four_text', 'four_btntext', 'four_imageone', 'four_imagetwo', 'four_txtone', 'four_txttwo', 'four_icon', 

	    'five_enable', 'five_heading', 'five_text', 'five_btntext', 'five_imageone', 'five_imagetwo', 'five_imagethree',

	    'six_enable', 'six_heading', 'six_txtone', 'six_txttwo', 'six_txtthree', 'six_deatilone', 'six_deatiltwo', 'six_deatilthree' ,

      'text_one', 'text_two', 'text_three', 'link_one', 'link_two', 'link_three', 'link_four' 
	];
}
