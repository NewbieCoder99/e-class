<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Slider;
use App\Categories;
use App\SubCategory; 
use App\ChildCategory;
use App\CourseLanguage;
use App\Page;
use App\Testimonial;
use App\WhatLearn;
use App\Question;
use App\CourseChapter;
use App\ReviewRating;
use App\Blog;
use App\FaqStudent;
use App\FaqInstructor;
use App\Order;
use DB;


class QuickUpdateController extends Controller
{
    public function courseQuick($id)
    {
    	$course = Course::findorfail($id);

    	if($course->status ==0)
    	{
    		DB::table('courses')->where('id','=',$id)->update(['status' => "1"]);	
    		return back()->with('success','Status changed to Active !');
    	}
    	else
    	{
    		DB::table('courses')->where('id','=',$id)->update(['status' => "0"]);
    		return back()->with('delete','Status changed to Deactive !');
    	}
    }

    public function userQuick($id)
    {
        $users = User::findorfail($id);

        if($users->status ==0)
        {
            DB::table('users')->where('id','=',$id)->update(['status' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('users')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }

    public function sliderQuick($id)
    {
        $sliders = Slider::findorfail($id);

        if($sliders->status ==0)
        {
            DB::table('sliders')->where('id','=',$id)->update(['status' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('sliders')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }


    public function courseabc($id)
    {
        $course = Course::findorfail($id);

        if($course->featured ==0)
        {
            DB::table('courses')->where('id','=',$id)->update(['featured' => "1"]);   
            return back()->with('success','Featured changed to YES !');
        }
        else
        {
            DB::table('courses')->where('id','=',$id)->update(['featured' => "0"]);
            return back()->with('delete','Featured changed to NO !');
        }
    }

    public function categoryQuick($id)
    {
        $categories = Categories::findorfail($id);

        if($categories->status ==0)
        {

            DB::table('categories')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('categories')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

    public function pageQuick($id)
    {
        $pages = Page::findorfail($id);

        if($pages->status ==0)
        {
            DB::table('pages')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('pages')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

    public function whatQuick($id)
    {
        $whatlearns = WhatLearn::findorfail($id);

        if($whatlearns->status ==0)
        {

            DB::table('what_learns')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('what_learns')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }
    public function ChapterQuick($id)
    {
        $coursechapters = CourseChapter::findorfail($id);

        if($coursechapters->status ==0)
        {
            DB::table('course_chapters')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('course_chapters')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

    public function ansrQuick($id)
    {
        $questionanswers = Question::findorfail($id);

        if($questionanswers->status ==0)
        {
            DB::table('questions')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('questions')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }
     public function faqQuick($id)
    {
        $faqs = FaqStudent::findorfail($id);

        if($faqs->status ==0)
        {
            DB::table('faq_students')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('faq_students')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

    public function faqInstructorQuick($id)
    {
        $faqs = FaqInstructor::findorfail($id);

        if($faqs->status ==0)
        {
            DB::table('faq_instructors')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('faq_instructors')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

      public function testimonialQuick($id)
    {
        $testimonials = Testimonial::findorfail($id);

        if($testimonials->status ==0)
        {

            DB::table('testimonials')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('testimonials')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

    public function languageQuick($id)
    {
        $languages = CourseLanguage::findorfail($id);

        if($languages->status ==0)
        {

            DB::table('course_languages')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('course_languages')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

    public function subcategoryQuick($id)
    {
        $subcategories = SubCategory::findorfail($id);

        if($subcategories->status ==0)
        {

            DB::table('sub_categories')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('sub_categories')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }

    public function childcategoryQuick($id)
    {
        $childcategories = ChildCategory::findorfail($id);

        if($childcategories->status ==0)
        {
            DB::table('child_categories')->where('id','=',$id)->update(['status' => "1"]); 
            return back()->with('success','Status changed to active !');
        }
        else
        {
            DB::table('child_categories')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to deactive !');
        }
    }


    public function categoryfQuick($id)
    {
        $categories = Categories::findorfail($id);

        if($categories->featured ==0)
        {
            DB::table('categories')->where('id','=',$id)->update(['featured' => "1"]); 
            return back()->with('success','featured changed to active !');
        }
        else
        {
            DB::table('categories')->where('id','=',$id)->update(['featured' => "0"]);
            return back()->with('delete','featured changed to deactive !');
        }
    }

    public function blog_statusQuick($id)
    {
        $review = Blog::findorfail($id);

        if($review->status == 0)
        {
            DB::table('blogs')->where('id','=',$id)->update(['status' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('blogs')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }

    public function blog_approvedQuick($id)
    {
        $review = Blog::findorfail($id);

        if($review->approved == 0)
        {
            DB::table('blogs')->where('id','=',$id)->update(['approved' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('blogs')->where('id','=',$id)->update(['approved' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }

    public function reviewstatusQuick($id)
    {
        $review = ReviewRating::findorfail($id);

        if($review->status ==0)
        {
            DB::table('review_ratings')->where('id','=',$id)->update(['status' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('review_ratings')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }

    public function reviewapprovedQuick($id)
    {
        $review = ReviewRating::findorfail($id);

        if($review->approved == 0)
        {
            DB::table('review_ratings')->where('id','=',$id)->update(['approved' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('review_ratings')->where('id','=',$id)->update(['approved' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }

    public function reviewfeaturedQuick($id)
    {
        $review = ReviewRating::findorfail($id);

        if($review->featured == 0)
        {
            DB::table('review_ratings')->where('id','=',$id)->update(['featured' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('review_ratings')->where('id','=',$id)->update(['featured' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }

    public function orderQuick($id)
    {
        $order = Order::findorfail($id);

        if($order->status == 0)
        {
            DB::table('orders')->where('id','=',$id)->update(['status' => "1"]);   
            return back()->with('success','Status changed to Active !');
        }
        else
        {
            DB::table('orders')->where('id','=',$id)->update(['status' => "0"]);
            return back()->with('delete','Status changed to Deactive !');
        }
    }
}
