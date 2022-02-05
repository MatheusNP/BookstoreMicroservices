<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class MailController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return the list of mails;
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $mails = Mail::all();

        return $this->successResponse($mails);
    }
}