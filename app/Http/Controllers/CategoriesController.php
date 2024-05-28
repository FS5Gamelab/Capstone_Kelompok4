<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriess = Categories::all();
        return view('admin.category.index', [
            'categoriess' => $categoriess
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'type_laundry' => 'required|string',
            'working_time' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $categories = new Categories($validateData);
        $categories->save();

        return redirect(route('listCategory'))->with('success', 'New Category Added Successfully');
    }

    public function restore(string $id)
    {
    $categories = Categories::onlyTrashed()->findOrFail($id);
    $categories->restore();

    return redirect(route('listCategory'))->with('success', 'Category Data Restored Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Categories::findOrFail($id);
        return view('admin.category.edit', [
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'type_laundry' => 'required|string',
            'working_time' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $categories = Categories::findOrFail($id);
        $categories->update($validateData);

        return redirect(route('listCategory'))->with('success', 'Category Data Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect(route('listCategory'))->with('success', 'Category Data Deleted Successfully');
    }
}
