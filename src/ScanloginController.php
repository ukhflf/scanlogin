<?php

namespace Ukhflf\Scanlogin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScanloginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = [];
        $data['appid'] = config('scanlogin.appid','');
        $data['agentid'] = config('scanlogin.agentid','');
        $data['redirect_uri'] = config('scanlogin.redirect_uri','');
        return view('vendor/scanlogin/login',$data);
    }


    /**
     * @return string
     */
    public function userInfo(){
        $config = Config::get('wechat.work.default');
        $app = Factory::work($config);

        $user = $app->oauth->detailed()->user();
        if(empty($user)){
            return redirect('admin/scanlogin');
        }

        // 获取用户信息
        $userId = $user->getId(); // 对应企业微信英文名（userid）
        $original = $user->getOriginal(); // 获取企业微信接口返回的原始信息
        $userInfo = $app->user->get($userId);

        //根据用户的微信userId 来验证用户有没有在系统里创建用户
        $adminUser = AdminUser::where(['username'=>$userInfo['mobile']])->first();
        if(!empty($adminUser)){
            //登陆用户信息
            $result = Admin::guard()->attempt(['username'=>$adminUser->username,'password'=>'ukhflf'.$adminUser->username],false);
            if($result){
                return redirect('/admin');
            }
        }else{
            //在系统里创建一个用户
            $data = [
                'username' => $userInfo['mobile'],
                'password' => bcrypt('ukhflf'.$userInfo['mobile']),
                'name' => $userInfo['name'],
                'avatar' => $userInfo['avatar'],
                'phone' => $userInfo['mobile'],
                'user_id' => $userInfo['userid'],
            ];

            $adminUser = AdminUser::create($data);
            DB::table('admin_role_users')->insert(['role_id'=>1,'user_id'=>$adminUser->id]);
            if($adminUser){
                $result = Admin::guard()->attempt(['username'=>$adminUser->username,'password'=>'ukhflf'.$adminUser->username],false);
                if($result){
                    return redirect('/admin');
                }
            }
        }

        return redirect('admin/scanlogin');
    }


}
