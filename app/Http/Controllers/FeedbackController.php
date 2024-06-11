<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function submitFeedback(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Simpan feedback ke database
        Feedback::create([
            'id_customer'=> Auth::id(),
            'id_order' => $id,
            'feedback' => $request->feedback,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }

    public function store(Request $request, $orderId)
    {
        $request->validate([
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'id_customer' => Auth::id(),
            'id_order' => $orderId,
            'feedback' => $request->feedback,
            'rating' => $request->rating,
        ]);

        return redirect()->route('orderCustomer')->with('success', 'Feedback submitted successfully.');
    }

    public function show($orderId)
    {
        $feedbacks = Feedback::where('id_order', $orderId)->get();
        return view('feedback.show', compact('feed_backs'));
    }
}
