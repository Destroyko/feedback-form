<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackCreateRequest;
use App\Models\Feedback;

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
            'author'  => $feedbackData['fullName'],
            'phone'   => $feedbackData['phoneNumber'],
            'message' => $feedbackData['message'],
        ]);

        return response()->json([
            'status' => 'success',
            'text' => 'Feedback was sent'
        ]);
    }
}
