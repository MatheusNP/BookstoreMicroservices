<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the mail microservice;
     *
     * @var MailService
     */
    private $mailService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Return the list of mails;
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->validResponse($this->mailService->index());
    }
}