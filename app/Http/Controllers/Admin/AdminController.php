<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Http\Requests;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class AdminController extends MainAdminController
{
    use FileUploadTrait;
    private $upload_path,$height,$width;

    public function __construct()
    {
        $this->upload_path = public_path("upload/members/");

        if (!File::isDirectory($this->upload_path)) {
            File::makeDirectory($this->upload_path, 0777, true, true);
        }
        $this->height=80;
        $this->width=80;
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function profile()
    {
        return view('admin.pages.profile');
    }

    public function updateProfile(Request $request)
    {

        $user = User::findOrFail(Auth::user()->id);


        $data = $request->except('_token');

        $rule = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:75|unique:users,id',
            'image_icon' => 'mimes:jpg,jpeg,gif,png'
        );

        $validator = \Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }


        $inputs = $request->all();


        // if($icon){


        // 	 $filename  = Str::slug($inputs['first_name'], '-') . '-' . md5(time());

        //      $path = public_path('upload/members/');

        // 	 $icon->move($path,$filename);

        // 	 $user->image_icon = 'upload/members/' . $filename;


        //    $user->image_icon = $filename;
        // }

        // if ($request->hasFile("user_icon")) {
        //     File::delete($this->upload_path . $user->image_icon);
        //     $img_tmp = $request->file("user_icon");
        //     $extension = $img_tmp->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     Image::make($img_tmp)
        //         ->resize($this->width, $this->height)
        //         ->save($this->upload_path . $filename);

        //     $input["user_icon"] = $filename;
        // } else {
        //     $input["user_icon"] = "";
        // }

        if ($request->hasFile('image_icon')) {
           
            if (!is_null($user->image_icon)) {
                
                $this->fileUpload($user, 'image_icon', 'user-image', true);
            }
            $this->fileUpload($user, 'image_icon', 'user-image', false);
        }


        // if($icon){
        //     $tmpFilePath = 'upload/members/';


        //     $hardPath = Str::slug($inputs['first_name'], '-').'-'.md5(time());

        //     $img = Image::make($icon);

        //     $img->fit(200, 200)->save($tmpFilePath.$hardPath.'-b.jpg');
        //     $img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

        //     $user->image_icon = $hardPath;
        // }


        $user->first_name = $inputs['first_name'];
        $user->last_name = $inputs['last_name'];
        $user->email = $inputs['email'];



        // $user->fill($input)->save();

        $user->save();

        Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {

        //$user = User::findOrFail(Auth::user()->id);


        $data =  \Input::except(array('_token'));
        $rule  =  array(
            'password'       => 'required|confirmed',
            'password_confirmation'       => 'required'
        );

        $validator = \Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        /* $val=$this->validate($request, [
                    'password' => 'required|confirmed',
            ]);  */

        $credentials = $request->only(
            'password',
            'password_confirmation'
        );

        $user = \Auth::user();
        $user->password = bcrypt($credentials['password']);
        $user->save();

        Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }
}
