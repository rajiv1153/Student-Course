<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    public function store(StoreCourseRequest $request){
        $data= array();
        $data['title']=$request->validated('title');      
        $image=$request->file('image');
        
        if($image){
            $image_name=date('dmy_H_s_i');
            $ext= strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/media/';
            $image_url= $upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
          
        }else{
            $data['image']='';
        }
        $product=DB::table('courses')->insert($data);
        return redirect()->route('admin.home')->with('success','Course Created Successfully');
        
    }

    public function delete($id){
        $data=DB::table('courses')->where('id',$id)->first();
        $image= $data->image;
        if($image){
            unlink($image);
        }
        DB::table('courses')->where('id',$id)->delete();
        DB::table('subscriptions')->where('course_id',$id)->delete();
        return redirect()->route('admin.home')->with('success','Course Deleted Successfully');
    }

    public function add(Request $request){
        $course=$request->courses;
        if(!$course){
            return redirect()->route('home')->with('success','Please Select at least one');
        }
            $data = [];
            foreach ($course as $value) {
                $a=['user_id'=>Auth::id(), 'course_id'=> $value];
                array_push($data,$a);
            }
            DB::table('subscriptions')->insert($data);        
            return redirect()->route('home')->with('success','Course Added Successfully');
    }

    public function remove($id){
        DB::table('subscriptions')->where('id',$id)->delete();
        return redirect()->route('home')->with('success','Course Removed Successfully');
    }
    
}
