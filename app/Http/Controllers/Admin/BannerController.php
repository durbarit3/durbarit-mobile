<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Carbon\Carbon;
use Session;
use Image;

class BannerController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // allbaner
    public function index(){
    	$allbanner=Banner::where('is_deleted',0)->get();
    	return view('admin.ecommerce.banner.all',compact('allbanner'));
	}
	// insert
	public function insert(Request $request){
        // return $request;
         $data = new Banner;
         $data->ban_link = $request->ban_link;

         if($request->hasFile('pic')){
            $image=$request->file('pic');
            $ImageName='th'.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(830,355)->save('public/uploads/banner/'.$ImageName);
            $data->ban_image =$ImageName;
          }
         if($request->hasFile('bottom_image')){
            $image=$request->file('bottom_image');
            $ImageName='bottom_image'.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(435,174)->save('public/uploads/banner/'.$ImageName);
            $data->bottom_image =$ImageName;

          }
           if($data->save()){
                $notification=array(
                    'messege'=>'Banner Insert Successfully',
                    'alert-type'=>'success'
                     );
                   return Redirect()->back()->with($notification);
             }else{
                  $notification=array(
                'messege'=>'Banner Insert Faild',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
             }


	}
	// active
	public function active($id){
		$active=Banner::where('id',$id)->update([
			'ban_status'=>'1',
			'updated_at'=>Carbon::now()->toDateTimeString(),
		]);
		if($active){
	             	 $notification=array(
	                'messege'=>'Banner Active Success',
	                'alert-type'=>'success'
	                 );
	               return Redirect()->back()->with($notification);
             }else{
             	 $notification=array(
                'messege'=>'Banner active Faild',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
             }
	}
	// deactive
	public function deactive($id){
			$deactive=Banner::where('id',$id)->update([
			'ban_status'=>'0',
			'updated_at'=>Carbon::now()->toDateTimeString(),
		]);
		if($deactive){
	             	 $notification=array(
	                'messege'=>'Banner deActive Success',
	                'alert-type'=>'success'
	                 );
	               return Redirect()->back()->with($notification);
             }else{
             	 $notification=array(
                'messege'=>'Banner Deactive Faild',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
             }
	}
	// softdelete
	public function softdelete($id){
		$softdelete=Banner::where('id',$id)->update([
			'is_deleted'=>'1',
			'updated_at'=>Carbon::now()->toDateTimeString(),
		]);
		if($softdelete){
	             	 $notification=array(
	                'messege'=>'Banner delete Success',
	                'alert-type'=>'success'
	                 );
	               return Redirect()->back()->with($notification);
             }else{
             	 $notification=array(
                'messege'=>'Banner delete Faild',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
             }
	}
	// multiple soft delete
	public function multisoftdelete(Request $request){
		$deleteid=$request->Input('delid');
                     if($deleteid){
                     $delet=Banner::whereIn('id',$deleteid)->update([
                     		'is_deleted'=>'1',
                     		'updated_at'=>Carbon::now()->toDateTimeString(),
                     ]);
                     if($delet){
                         $notification=array(
                            'messege'=>'success',
                            'alert-type'=>'success'
                             );
                         return redirect()->back()->with($notification);
                     }else{
                         $notification=array(
                            'messege'=>'error',
                            'alert-type'=>'error'
                             );
                         return redirect()->back()->with($notification);
                        }
                     }else{
                        $notification=array(
                            'messege'=>'Nothing To Delete',
                            'alert-type'=>'info'
                             );
                         return redirect()->back()->with($notification);
                     }
	}
	// edit
	public function edit($id){
		$data=Banner::where('id',$id)->first();
		return json_encode($data);
	}
	// update
	public function update(Request $request){
			$id=$request->id;
			$old_image=$request->old_image;
			$update=Banner::where('id',$id)->update([
					'ban_link'=>$request['ban_link'],
					'updated_at'=>Carbon::now()->toDateTimeString(),
			]);
			 if($request->hasFile('pic')){
                    if($old_image){
                        unlink('public/uploads/banner/'.$old_image);
                        $image=$request->file('pic');
                        $ImageName='_'.'_'.time().'.'.$image->getClientOriginalExtension();
                        Image::make($image)->resize(830,355)->save('public/uploads/banner/'.$ImageName);
                        Banner::where('id',$id)->update([
                            'ban_image'=>$ImageName,
                        ]);
                    }

                }
        if($request->hasFile('bottom_image')){
           $image=$request->file('bottom_image');
           $ImageName='bottom_image'.'_'.time().'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize(435,174)->save('public/uploads/banner/'.$ImageName);
           Banner::where('id',$id)->update([
               'bottom_image'=>$ImageName,
           ]);

         }

        	if($update){
                 $notification=array(
                    'messege'=>'success',
                    'alert-type'=>'success'
                     );
                 return redirect()->back()->with($notification);
             }else{
                 $notification=array(
                    'messege'=>'error',
                    'alert-type'=>'error'
                     );
                 return redirect()->back()->with($notification);
                }
	}
	// restore
	public function restore($id){
		$restore=Banner::where('id',$id)->update([
			'is_deleted'=>'0',
			'updated_at'=>Carbon::now()->toDateTimeString(),
		]);
		if($restore){
	             	 $notification=array(
	                'messege'=>'Banner Restore Success',
	                'alert-type'=>'success'
	                 );
	               return Redirect()->back()->with($notification);
             }else{
             	 $notification=array(
                'messege'=>'Banner Restore Faild',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
             }
	}

	//heard delete
	public function multihearddelete($id){

		$bnimage=Banner::where('id',$id)->first();
		$image_old=$bnimage->ban_image;
		unlink('public/uploads/banner/'.$image_old);
		$hearddelete=Banner::where('id',$id)->delete();

		if($hearddelete){
			$notification=array(
                'messege'=>'Banner hearddelete',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
		}else{
			$notification=array(
                'messege'=>'Banner hearddelete',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
		}

	}

    // site banner----------------------------------------------------------------------




    // site banner end ---------------------------------------------------------------------
}
