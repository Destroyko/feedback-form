<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackCreateRequest;
use App\Mail\FeedbackMail;
use App\Models\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    private Feedback $feedbackModel;

    public function __construct()
    {
        $this->feedbackModel = new Feedback();
    }

    public function create(FeedbackCreateRequest $request)
    {
        $feedbackData = $request->validated();

        $this->feedbackModel->create([
            'author'       => $feedbackData['fullName'],
            'phone'        => $feedbackData['phoneNumber'],
            'countries_id' => $feedbackData['country'],
            'message'      => $feedbackData['message'],
        ]);

        Mail::to(config('mail.from.address'))->send(new FeedbackMail($feedbackData));

        return response()->json([
            'status' => 'success',
            'text'   => 'Feedback was sent'
        ]);
    }
}
