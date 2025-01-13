<?php

namespace App\Http\Controllers\API\Web\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User as UserDB;

use Illuminate\Validation\Rules\Password;
use Hash;
use Auth;
use Validator;
use Carbon\Carbon;
use Str;
use DB;

class UserLoginController extends Controller
{
    //發送驗證碼驗證規則
    protected $sendVerifyCodeRules = [
        'nation' => 'required|string|regex:/^[+o0-9]+$/|max:5',
        'mobile' => 'required|numeric',
        'type' => 'required|in:register,resetPassword',
        'from_site' => 'required|string|max:10',
    ];
    //檢驗驗證碼驗證規則
    protected $confirmVerifyCodeRules = [
        'nation' => 'required|string|regex:/^[+o0-9]+$/|max:5',
        'mobile' => 'required|numeric',
        'verifyCode' => 'required|numeric',
        'from_site' => 'required|string|max:10',
    ];

    public function __construct()
    {
        //除了 login 其餘 function 都要經過 api 的 middleware 檢查
        $this->middleware(['api','refresh.token'], ['except' => ['login','confirmVerifyCode','sendVerifyCode','register','forgetPassword']]);

        //註冊資料規則
        $this->registerRules = [
            'nation' => 'required|string|regex:/^[+o0-9]+$/|max:4',
            'mobile' => 'required|numeric|min_digits:9|max_digits:11',
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:255',
            'birthDay' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()],
            // 'password' => 'required|string|min:8',
            // 'password_confirmation ' => 'required|same:password|min:8',
            // 'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()],
            // 'pickupDate' => [Rule::requiredIf(function () use ($request) {
            //     return ($request->from_country_id == 1 && $request->to_country_id == 1);
            // }),'date'],
            // 'email' => ['required_if:type,editProfile',
            // function ($attribute, $value, $fail) {
            //     if(!empty($this->request->email)){
            //         if(!preg_match("/^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$/", $this->request->email)){
            //             $fail('E-mail 必須是有效的 E-mail。');
            //         }
            //     }
            // }
            // ,'max:255'],
        ];

        //登入驗證規則
        $this->loginRules = [
            // 'nation' => 'required|string|regex:/^[+o0-9]+$/|max:4',
            // 'mobile' => 'required|numeric|min_digits:9|max_digits:11',
            'email' => 'required|email|max:255',
            'password' => ['required', Password::min(8)->numbers()->letters()->mixedCase()],
        ];

            //忘記密碼
        $this->forgetPasswordRules = [
            // 'nation' => 'required|string|regex:/^[+o0-9]+$/|max:5',
            // 'mobile' => 'required|numeric',
            'email' => 'required|email|max:255',
            'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()],
        ];
    }
    //登入
    public function login(Request $request)
    {
        $code = 999;
        $httpCode = 400;
        $status = 'Error';
        $message = 'No Data Input';
        if(!empty($request->getContent())){
            $getJson = $request->getContent();
            $data = json_decode($getJson, true);
            if(!empty($data)){
                //驗證失敗返回訊息
                if (Validator::make($request->all(), $this->loginRules)->fails()) {
                    return $this->appCodeResponse('Error', 999, Validator::make($request->all(), $this->loginRules)->errors(), 400);
                }
                $httpCode = 200;
                //將進來的資料作參數轉換(只取rule中有的欄位)
                foreach ($data as $key => $value) {
                    if(in_array($key, array_keys($this->registerRules))){
                        $$key = $value;
                    }
                }
                $user = UserDB::where('email',$email)->first();
                if (!empty($user)) {
                    if($user->status == -1){
                        return $this->appCodeResponse('Error', -1, '使用者已停用', 403);
                    }elseif($user->status == 0){
                        return $this->appCodeResponse('Error', 0, '使用者尚未通過驗證', 401);
                    }elseif($user->status == 1){
                        //紀錄
                        $token = auth('webapi')->login($user);
                        return $this->respondWithToken($user,$token);
                        //檢查是否已經登入過, 有則註銷舊的Token, 這樣是否會造成另一個瀏覽器登入被登出?
                        // return $this->debugResponse(auth('webapi')->getPayload());
                        // if(auth('webapi')->check()){
                        //     auth('webapi')->invalidate(true);
                        // }
                    }
                }else{
                    $code = 1;
                    $message = '使用者不存在/密碼錯誤。';
                }
            }else{
                $message = 'JSON Data Decoded Failure';
            }
        }
        return $this->appCodeResponse($status, $code, $message, $httpCode);
    }

    //登出
    public function logout(Request $request)
    {
        auth('webapi')->logout();
        return $this->appCodeResponse('Success', 0, '登出成功', 200);
    }

    //手動更新token
    public function refresh()
    {
        $id = auth('webapi')->user()->id;
        $user = UserDB::findOrFail($id);
        $newToken = auth('webapi')->refresh(true, true);
        return $this->respondWithToken($user,$newToken);
    }

    //開發測試用
    public function me()
    {
        return response()->json(auth('webapi')->user());
    }

    // //拋出token
    protected function respondWithToken($user,$token)
    {
        return response()->json([
            'status' => 'Success',
            'user_id' => $user->id,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('webapi')->factory()->getTTL(),
        ],200)->header('Authorization','Bearer '.$token);
    }

    // //發送驗證碼
    // public function sendVerifyCode(Request $request)
    // {
    //     //驗證失敗返回訊息
    //     if (Validator::make($request->all(), $this->sendVerifyCodeRules)->fails()) {
    //         return $this->appCodeResponse('Error', 999, Validator::make($request->all(), $this->sendVerifyCodeRules)->errors(), 400);
    //     }
    //     //將進來的資料作參數轉換(只取rule中有的欄位)
    //     foreach ($request->all() as $key => $value) {
    //         if(in_array($key, array_keys($this->sendVerifyCodeRules))){
    //             $$key = $value;
    //         }
    //     }
    //     //檢查使用者是否存在
    //     $mobile = ltrim($mobile,'0');
    //     $nation != 'o' ? $nation = '+'.str_replace(['+','-','_'],['','',''],$nation) : '';
    //     $fullMobile = $nation.$mobile;
    //     $user = UserDB::whereRaw(" AES_DECRYPT(mobile,'$this->aesKey') = '$mobile' ")
    //     ->where('from_site',$from_site)
    //     ->where(function($q)use($nation){
    //         $q->where('nation',$nation)->orWhere('nation','');
    //     })->select(['id','status','verify_code'])->first();
    //     if(!empty($user)){
    //         if ($user->status == -1) {
    //             return $this->appCodeResponse('Error', -1, '此手機號碼已停用。', 403);
    //         }elseif ($user->status == 1) {
    //             if($type == 'resetPassword'){
    //                 return $this->sendCode($fullMobile, $user);
    //             }
    //             if ($type == 'register') {
    //                 return $this->appCodeResponse('Error', 1, '此手機號碼已註冊。', 403);
    //             }
    //         }elseif ($user->status == 0) {
    //             if ($type == 'resetPassword') {
    //                 return $this->appCodeResponse('Error', 0, '此手機號碼尚未完成註冊程序。', 403);
    //             }
    //             if ($type == 'register') { //未完成驗證一樣發送驗證碼
    //                 return $this->sendCode($fullMobile, $user);
    //             }
    //         }
    //     }else{
    //         if ($type == 'resetPassword') {
    //             return $this->appCodeResponse('Error', 2, '此手機號碼不存在/驗證碼錯誤。', 400);
    //         }
    //         if ($type == 'register') {
    //             return
    //             $user = UserDB::create([
    //                 'name' => 'new user',
    //                 'email' => "new user's email",
    //                 'nation' => $nation,
    //                 'mobile' => DB::raw("AES_ENCRYPT('$mobile', '$this->aesKey')"),
    //                 'status' => 0,
    //                 'from_site' => $from_site,
    //             ]);
    //             return $this->sendCode($fullMobile, $user);
    //         }
    //     }
    // }

    // //檢驗驗證碼
    // public function confirmVerifyCode(Request $request)
    // {
    //     //驗證失敗返回訊息
    //     if (Validator::make($request->all(), $this->confirmVerifyCodeRules)->fails()) {
    //         return $this->appCodeResponse('Error', 999, Validator::make($request->all(), $this->confirmVerifyCodeRules)->errors(), 400);
    //     }
    //     //將進來的資料作參數轉換(只取rule中有的欄位)
    //     foreach ($request->all() as $key => $value) {
    //         if(in_array($key, array_keys($this->confirmVerifyCodeRules))){
    //             $$key = $value;
    //         }
    //     }
    //     //檢查使用者是否存在
    //      $mobile = ltrim($mobile,'0');
    //     $nation != 'o' ? $nation = '+'.str_replace(['+','-','_'],['','',''],$nation) : '';
    //     $fullMobile = $nation.$mobile;
    //     $user = UserDB::whereRaw(" AES_DECRYPT(mobile,'$this->aesKey') = '$mobile' ")
    //     ->where('from_site',$from_site)
    //     ->where('verify_code',$verifyCode)
    //     ->where(function($q)use($nation){
    //         $q->where('nation',$nation)->orWhere('nation','');
    //     })->select(['id','status','verify_code'])->first();
    //     if(!empty($user)){
    //         return $this->appCodeResponse('Success', 0, '驗證碼驗證成功。', 200);
    //     }else{
    //         return $this->appCodeResponse('Error', 9, '驗證碼驗證失敗。', 400);
    //     }
    // }

    //註冊資料
    /**
     * @OA\POST(
     *     path="/web/v1/register",
     *     operationId="webRegister",
     *     tags={"前台使用者登入登出"},
     *     summary="前台使用者註冊資料",
     *     description="前台使用者註冊資料。",
     *      @OA\RequestBody (
     *           required = true,
     *           @OA\JsonContent(
     *               required = {"nation","mobile","name","email","password","password_confirmation"},
     *               example={
     *                  "nation" : "+886",
     *                  "mobile": "987654321",
     *                  "name": "測試專家",
     *                  "email": "test@test.com",
     *                  "password": "Aa12345@",
     *                  "password_confirmation": "Aa12345@",
     *                  "birthDay": "2000-01-01",
     *                  "address": "測試市測試區測試路1001號100F",
     *               },
     *               @OA\Property(
     *                   property="nation",
     *                   type="string(4)",
     *                   description="國際碼，EX: +886"
     *               ),
     *               @OA\Property(
     *                   property="mobile",
     *                   type="digits(11)",
     *                   description="行動電話號碼"
     *               ),
     *               @OA\Property(
     *                   property="name",
     *                   type="string(40)",
     *                   description="名字"
     *               ),
     *               @OA\Property(
     *                   property="email",
     *                   type="string(255)",
     *                   format="email",
     *                   description="電子郵件"
     *               ),
     *               @OA\Property(
     *                   property="password",
     *                   type="string(255)",
     *                   format="password",
     *                   description="密碼，至少八個字元，至少包含一個數字及一個大寫"
     *               ),
     *               @OA\Property(
     *                   property="password_confirmation",
     *                   type="string(255)",
     *                   format="password",
     *                   description="確認密碼，至少八個字元，至少包含一個數字及一個大寫"
     *               ),
     *               @OA\Property(
     *                   property="birthDay",
     *                   type="string(10)",
     *                   format="date",
     *                   description="生日,ex: 2020-01-01"
     *               ),
     *               @OA\Property(
     *                   property="address",
     *                   type="string(255)",
     *                   description="地址"
     *               ),
     *           ),
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="Success,<br>appCode = 0: 註冊完成。自動登入，取得 Authorization 授權。<br>appCode = -9: 該帳號已被使用者註記刪除，無法註冊。<br>appCode = -1: 該帳號已被停用，無法註冊。<br>appCode = 2: 該帳號未完成註冊。<br>",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error, appCode = 999: 參數不存在/參數錯誤。",
     *     ),
    * )
    */

    public function register(Request $request)
    {
        $code = 999;
        $httpCode = 400;
        $status = 'Error';
        $message = 'No Data Input';
        $token = null;
        if(!empty($request->getContent())){
            $getJson = $request->getContent();
            $data = json_decode($getJson, true);
            if(!empty($data)){
                //驗證失敗返回訊息
                if (Validator::make($data, $this->registerRules)->fails()) {
                    return $this->appCodeResponse('Error', 999, Validator::make($data, $this->registerRules)->errors(), 400);
                }
                //將進來的資料作參數轉換(只取rule中有的欄位)
                foreach ($data as $key => $value) {
                    if(in_array($key, array_keys($this->registerRules))){
                        $$key = $value;
                    }
                }
                $mobile = $data['mobile'] = ltrim($mobile,'0');
                $nation = $data['nation']= '+'.str_replace('+','',$nation);
                $data['phone'] = $nation.$mobile;
                $data['password'] = $password = Hash::make($data['password']);
                $user = UserDB::where('email',$email)->first();
                if(!empty($user)){
                    if($user->status == -9){
                        $code = -9;
                        $message = '該帳號已被使用者註記刪除，無法註冊。';
                    }elseif($user->status == -1){
                        $code = -1;
                        $message = '該帳號已被停用，無法註冊。';
                    }elseif($user->status == 0){
                        $code = 2;
                        $message = '該帳號未完成註冊。';
                    }else{
                        $code = 9;
                        $message = '該帳號已存在。';
                    }
                }else{
                    $data['status'] = 1;
                    $user = UserDB::create($data);
                    $code = 0;
                    $httpCode = 200;
                    $status = 'Success';
                    $message = '註冊完成。';
                    $token = auth('webapi')->login($user);
                }
            }else{
                $message = 'JSON Data Decoded Failure';
            }
        }
        if(!empty($token)){
            return $this->appCodeResponse($status, $code, $message, $httpCode)->header('Authorization','Bearer '.$token);
        }else{
            return $this->appCodeResponse($status, $code, $message, $httpCode);
        }
    }

    // //忘記密碼
    // public function forgetPassword(Request $request)
    // {
    //     //驗證失敗返回訊息
    //     if (Validator::make($request->all(), $this->forgetPasswordRules)->fails()) {
    //         return $this->appCodeResponse('Error', 999, Validator::make($request->all(), $this->forgetPasswordRules)->errors(), 400);
    //     }
    //     //將進來的資料作參數轉換(只取rule中有的欄位)
    //     foreach ($request->all() as $key => $value) {
    //         if(in_array($key, array_keys($this->forgetPasswordRules))){
    //             $$key = $value;
    //             $data[$key] = $value;
    //         }
    //     }
    //     //檢查使用者是否存在
    //     $data['mobile'] = $mobile = ltrim($mobile,'0');
    //     $nation != 'o' ? $nation = '+'.str_replace('+','',$nation) : '';
    //     $nation != 'o' ? $data['nation'] = '+'.str_replace('+','',$nation) : '';
    //     $user = UserDB::whereRaw(" AES_DECRYPT(mobile,'$this->aesKey') = '$mobile' ")
    //     ->where('from_site',$from_site)
    //     ->where('verify_code',$verifyCode)
    //     ->where(function($q)use($nation){
    //         $q->where('nation',$nation)->orWhere('nation','');
    //     })->select(['id','status','verify_code'])->first();
    //     if($user){
    //         if($user->status == -1){
    //             return $this->appCodeResponse('Error', -1, '此手機號碼已停用。', 403);
    //         }elseif($user->status == 0){
    //             return $this->appCodeResponse('Error', 0, '此手機號碼尚未完成註冊。', 403);
    //         }
    //         //密碼處理
    //         !empty($data['password']) ? $data['password'] = sha1($data['password']) : '';
    //         //電話加密
    //         $data['mobile'] = DB::raw("AES_ENCRYPT('$mobile', '$this->aesKey')");
    //         //更新密碼資料
    //         $token = auth('webapi')->login($user);
    //         $user = $user->update($data);
    //         return $this->appCodeResponse('Success', 1, '密碼更新完成。', 200)->header('Authorization','Bearer '.$token);
    //     }else{
    //         return $this->appCodeResponse('Error', 2, '此手機號碼不存在/驗證碼錯誤。', 400);
    //     }
    // }

    // private function sendCode($phone, $user)
    // {
    //     $now = date('Y-m-d H:i:s');
    //     $smsLog = SmsLogDB::where('user_id',$user->id)->orderBy('created_at','desc')->first();
    //     //延遲1分鐘時間,避免連續發送
    //     if($smsLog){
    //         $now = strtotime(date('Y-m-d H:i:s'));
    //         $delay = strtotime($smsLog->created_at) + 60;
    //         if($now < $delay){
    //             return $this->appCodeResponse('Error', 9, '發送過於頻繁，請稍後再試。', 400);
    //         }
    //     }
    //     $sms = [];
    //     //產生隨機碼
    //     $verifyCode=rand(1000,9999);
    //     $user->update(['verify_code' => $verifyCode]);
    //     $message="$verifyCode (iCarry Verification Code)";
    //     $sms['user_id'] = $user->id;
    //     $sms['phone'] = $phone;
    //     $sms['message'] = substr($phone,0,3)=="+86" ? $verifyCode : (substr($phone,0,4)=="+886" ? $message="親愛的iCarry用戶您好，您的手機認證碼為".$verifyCode."，謝謝。" : $message);
    //     $sms['return'] = true;
    //     $status = AdminSendSMS::dispatchNow($sms); //馬上執行
    //     if($status['status'] == '傳送成功' || $status['status'] == '已送達業者'){
    //         return $this->appCodeResponse('Success', 0, '驗證碼已傳送。', 200);
    //     }else{
    //         return $this->appCodeResponse('Error', 99, '發送失敗。', 500);
    //     }
    // }
}
