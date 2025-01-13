<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ApiResponser;
use App\Traits\UniversalFunctionTrait;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="NewProject API Documents",
 *      description="Laravel new project api description
1. 同一個client連線API預設限制60次/分鐘，超過則會出現Too Many Requests(429)被限制10秒鐘無法訪問API。
2. API右邊若有鎖頭代表需要輸入 Authorization 來使用，請找到相對應(前台使用者、後台管理者)的API登入取得Token。
3. Authorization 過期前若干時間將會自動更並附加到 header 中，請隨時檢查 Authorization 是否有更新。
4. API Query 中 header 中若帶有 Authorization 資料，將會返回原來的 Authorization 。 (系統性錯誤則不返回)",
 *      @OA\Contact(
 *          email="weayzehoa@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\PathItem(
 *      path="/"
 *  )
 * @OA\server(
 *      url = "https://newapi.localhost",
 *      description="Localhost 測試區"
 * )
 * @OA\server(
 *      url = "https://newapi.rvt.idv.tw",
 *      description="RVT 線上測試區"
 * )
 * @OA\SecurityScheme(
 *    type="http",
 *    description="Login to 前台-使用者  get the authentication token",
 *    name="authentication",
 *    in="header",
 *    scheme="bearer",
 *    bearerFormat="JWT",
 *    securityScheme="webAuth",
 * )
 * @OA\SecurityScheme(
 *    type="http",
 *    description="Login to 後台-管理者 get the authentication token",
 *    name="authentication",
 *    in="header",
 *    scheme="bearer",
 *    bearerFormat="JWT",
 *    securityScheme="adminAuth",
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests,  DispatchesJobs, ValidatesRequests, ApiResponser, UniversalFunctionTrait;
}
