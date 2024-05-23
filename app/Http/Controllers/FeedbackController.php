<?php

namespace App\Http\Controllers;

use App\Models\Feedbacks;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedbacks::all();
        return view('feedback.index', [
            'feedbacks' => $feedbacks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = \App\Models\Customers::all();
        $users = \App\Models\User::all();
        $orders = \App\Models\Orders::all();
        return view('feedback.create', [
            'customers' => $customers,
            'users' => $users,
            'orders' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'id_customer' => 'required|integer',
            'id_user' => 'required|integer',
            'id_order' => 'required|integer',
            'feedback' => 'required|string',
            'rating' => 'required|string'
        ]);

        //create ulasan
        Feedbacks::create([
            'id_customer' => $request->id_customer,
            'id_user' => $request->id_user,
            'id_order' => $request->id_order,
            'feedback' => $request->feedback,
            'rating' =>$request->rating
        ]);

        //redirect to index
        return redirect(route('listFeedback'))->with('success', 'Ulasan Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedbacks $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customers = \App\Models\Customers::all();
        $users = \App\Models\User::all();
        $orders = \App\Models\Orders::all();
        $feedback = Feedbacks::findOrFail($id);
        return view('feedback.edit', [
            'feedback' => $feedback,
            'customers' => $customers,
            'users' => $users,
            'orders' => $orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'id_customer' => 'required|integer',
            'id_user' => 'required|integer',
            'id_order' => 'required|integer',
            'feedback' => 'required|string',
            'rating' => 'required|string'
        ]);

        //untuk mengambil ID Artikel
        $feedback = Feedbacks::findOrFail($id);

        //mengarahkan ke halaman index artikel
        return redirect(route('listFeedback'))->with('success', 'Data Ulasan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = Feedbacks::findOrFail($id);

        $feedback->delete();
        return redirect(route('listFeedback'))->with('success', 'Data Ulasan Berhasil Dihapus');
    }
}