<?php

namespace App\Http\Controllers;

use App\Models\Ideas;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_ideas = Ideas::query()->orderBy('created_at', 'DESC')->paginate(2);
        return view('dashboard', [
            'ideas' => $list_ideas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idea' => 'required|min:5|max:250'
        ]);
        $ideas = new Ideas(
            [
                'content' => $request->get('idea'),
            ]
        );
        $ideas->save();
        return redirect('/')->with('success', 'Idea Sukses Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ideas $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ideas $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ideas $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ideas $idea)
    {
        $idea->delete();
        return redirect('/')->with('success', 'Ideas Berhasil Dihapus');
    }
}
