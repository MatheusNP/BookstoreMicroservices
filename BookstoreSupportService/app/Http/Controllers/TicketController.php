<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\Ticket;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends Controller
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
     * List all the user's tickets;
     *
     * @param Request $request
     * @param integer $user_id
     * @return JsonResponse
     */
    public function list(Request $request, int $user_id): JsonResponse
    {
        $tickets = Ticket::where('user_id', $user_id)->get();

        return $this->successResponse($tickets);
    }

    /**
     * Create a ticket for the user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'user_id' => 'required|min:1',
            'email' => 'required|email',
            'description' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $ticket = Ticket::create([
            'user_id' => $request->user_id,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        $username = $request->username;

        $mail = new Mail(
            env('MAIL_TO', "support.bookstore@gmail.com"),
            env('MAIL_SUBJECT', "Query from bookstore"),
            "Name: {$username}\nEmail: {$ticket->email}\n\n{$ticket->description}",
            "From: {$username} <{$ticket->email}>"
        );
        event(new \App\Events\MailCreatedEvent($mail));

        $mail = new Mail(
            $ticket->email,
            env('MAIL_RES_SUBJECT', "Confirmation of receiving your query"),
            "Dear {$username}\n\nThanks for reaching us.\nThis is to inform you that we have received your query. We will get back to you asap.\n\nNote : This is an auto-generated mail do not reply to this."
        );
        event(new \App\Events\MailCreatedEvent($mail));

        return $this->successResponse($ticket, Response::HTTP_CREATED);
    }
}
