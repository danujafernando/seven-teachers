<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Breadcrumbs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admins');
        $this->grade = [ 6, 7, 8, 9, 10, 11, 12, 13];
    }

    public function show($grade = null){
        array_push(Breadcrumbs::$breadcrumb,array('Dashboard',''));
        if(!$grade){
            $grade = $this->grade[0];
        }else{
            if(!in_array($grade, $this->grade)){
                session()->flash('error_message','Grade doesn\'t exist');
                return redirect()->to(route('banner.get'));
            }
        }
        
        $banner = Banner::where('grade', $grade)->first();
        if(!$banner){
            $banner = new Banner();
            $banner->grade = $grade;
            $banner->image_1_url = null;
            $banner->image_2_url = null;
            $banner->image_3_url = null;
            $banner->save();
        }
        $grades = $this->grade;
        return view('admin.banner', compact('banner', 'grades', 'grade'));
    }

    public function upload(Request $request){
        $grade = $request->get('grade');
        if(!in_array($grade, $this->grade)){
            session()->flash('error_message','Grade doesn\'t exist');
            return redirect()->to(route('banner.get'));
        }
        $class_image_1 = $request->file('class_image_1');
        $class_image_2 = $request->file('class_image_2');
        $class_image_3 = $request->file('class_image_3');
        if(empty($class_image_1) && empty($class_image_2) && empty($class_image_3)){
            session()->flash('error_message','Banner Images inserted unsuccessfully');
            return redirect()->back();
        }
        $t=time();
        $banner = Banner::where('grade', $grade)->first();
        $status = 1;
        if(!$banner){
            $banner = new Banner();
            $banner->grade = $grade;
            $status = 0;
        }
        if($class_image_1){
            if($status){
                if(file_exists($banner->image_1_url)){
                    unlink($banner->image_1_url);
                }
            }
            $ext = $class_image_1->getClientOriginalExtension();
            $fileName = "banner_image_".$t.'.'.$ext;
            $location = public_path('images/banner_images/');
            $class_image_1->move($location, $fileName);
            $image_1_path = 'images/banner_images/'.$fileName;
            $banner->image_1_url = $image_1_path;
        }
        if($class_image_2){
            if($status){
                if(file_exists($banner->image_2_url)){
                    unlink($banner->image_2_url);
                }
            }
            $ext = $class_image_2->getClientOriginalExtension();
            $fileName = "banner_image_".$t.'.'.$ext;
            $location = public_path('images/banner_images/');
            $class_image_2->move($location, $fileName);
            $image_2_path = 'images/banner_images/'.$fileName;
            $banner->image_2_url = $image_2_path;
        }
        if($class_image_3){
            if($status){
                if(file_exists($banner->image_3_url)){
                    unlink($banner->image_3_url);
                }
            }
            $ext = $class_image_3->getClientOriginalExtension();
            $fileName = "banner_image_".$t.'.'.$ext;
            $location = public_path('images/banner_images/');
            $class_image_3->move($location, $fileName);
            $image_3_path = 'images/banner_images/'.$fileName;
            $banner->image_3_url = $image_3_path;
        }
        $banner->save();
        session()->flash('success_message','Banner images have been updated successfully');
        return redirect()->to(route('banner.get', [ $grade ]));
    }

    public function remove($id, $slot){
        $banner = Banner::find($id);
        if(!$banner){
            session()->flash('error_message','This banner doesn\'t exists');
        }
        if($slot == 1){
            if(file_exists($banner->image_1_url)){
                unlink($banner->image_1_url);
            }
            $banner->image_1_url = null;
        }
        if($slot == 2){
            if(file_exists($banner->image_2_url)){
                unlink($banner->image_2_url);
            }
            $banner->image_2_url = null;
        }
        if($slot == 3){
            if(file_exists($banner->image_3_url)){
                unlink($banner->image_3_url);
            }
            $banner->image_3_url = null;
        }
        $banner->save();
        session()->flash('success_message','Banner image have been removed successfully');
        return redirect()->back();
    }
}
