<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Response;
use Stripe\Stripe;
use App\Model\User;
use App\Helpers\StripeHelper;
use App\Model\PageContent;
use Illuminate\Contracts\Encryption\DecryptException;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $perPage = 10;



    /**
     * send response to user.
     *
     * @return json
     */
    // ,200,[],JSON_PRESERVE_ZERO_FRACTION
    public function toJson($result = [], $message = '', $status = 1)
    {
     

        return response()->json([
            'status' => $status,
            'result' => !empty($result) ? $result : new \stdClass(),
            'message' => $message,
        ], 200,[],JSON_PRESERVE_ZERO_FRACTION);
    }


}
