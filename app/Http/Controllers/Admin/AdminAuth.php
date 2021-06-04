<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuth extends Controller {

    protected function login(){
        return view('admin.login');
    }

    protected function doLogin(){
        $remember = request('rememberme') == 1?true:false;

        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        /*
         * $c = request()->only('email','password');
         * if(auth()->guard('admin')->attempt($c,$remember)){
        */
        if(admin()->attempt(['email'=>request('email'),'password'=>request('password')],$remember)){
            return redirect(aurl());
        }else{
            session()->flash('error',trans('admin.email_or_password_field'));
            return redirect(aurl('login'));
        }
    }

    protected function logout(){
        admin()->logout();
        return redirect(aurl('login'));
    }

    protected function forgotPassword(){
        return view('admin.forgot_password');
    }

    protected function forgotPasswordPost(){
        request()->validate([
            'email' => 'required',
        ]);
        // نتأكد هل الايميل موجود في قاعدة البيانات او لا
        $admin = Admin::where('email',request('email'))->first();
        if(!empty($admin)){ // اذا الايميل موجود
            // نستخدم البروكر لكي يعمل لنا توكن على ايميل الادمن
            $token = app('auth.password.broker')->createToken($admin);
            // نستخدم كلاس الدي بي لكي ندخل البيانات الى القاعدة في جدول ريست باسورد
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email, // الايميل المرسل
                'token' => $token, // التوكن الذي تم توليده
                'created_at' => Carbon::now(), // الكاربون الذي سيولد لنا الوقت
            ]);
            // نعمل إعادة لكي نرى شكل الايميل كيف سيظهر
//            return new AdminResetPassword([ 'data' => $admin , 'token' => $token ]);
            Mail::to($admin->email)->send(new AdminResetPassword([ 'data' => $admin , 'token' => $token ]));
            session()->flash('success',trans('admin.reset_link_is_sent_to_your_email'));
            return back();
        }else{
            session()->flash('error',trans('admin.email_is_incorrect'));
        }
        return back();
    }

    protected function resetPassword($token){
//         نعمل مسح على جدول الريست باسورد من خلال التوكن ونتأكد هل التوكن تم حفظه قبل اقل من ساعتين او لا ونجلب أول نتيجه
        $check_token = DB::table('password_resets')->where('token',$token)->where('created_at','>', Carbon::now()->subHours(2))->first();
        // إذا فعلا موجود التوكن سنقوم بتوجيهه لصفحة اعادة تعيين كلمة المرور او سنقوم باظهار رسالة خطأ له
        if(!empty($check_token)){
            return view('admin.reset_password',['data'=>$check_token]);
        }else{
            session()->flash('error',trans('admin.you_have_some_error'));
            return redirect(aurl('forgotPassword'));
        }
    }

    protected function resetNewPassword($token){
        $this->validate(request(),[
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ],[],[
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'password_confirmation' => trans('admin.password_confirmation')
        ]);
        $check_token = DB::table('password_resets')
            ->where('email',request('email'))
            ->where('token',$token)
            ->where('created_at','>', Carbon::now()->subHours(2))
            ->first();
        if (!empty($check_token)){
            if(Admin::where('email',request('email'))->update(['password'=>bcrypt(request('password'))])){
                DB::table('password_resets')->where('email',request('email'))->delete();
                session()->flash('success',trans('admin.your_password_is_reset'));
                return redirect(aurl('login'));
            }else{
                session()->flash('error',trans('admin.you_have_some_error'));
                return back();
            }
        }else{
            session()->flash('error',trans('admin.you_have_some_error'));
            return back();
        }
    }
}
