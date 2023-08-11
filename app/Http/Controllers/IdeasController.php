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
        $list_ideas = Ideas::query()->orderBy('created_at', 'DESC');
        if (request()->has('search')) {
            $list_ideas = $list_ideas->where('content', 'like', '%' . request()->get('search') . '%');
        }
        return view('dashboard', [
            'ideas' => $list_ideas->paginate(2)
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
            'content' => 'required|min:5|max:250'
        ]);
        $ideas = new Ideas(
            [
                'content' => $request->get('content'),
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
    public function edit(Ideas $idea)
    {
        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ideas $idea)
    {
        $request->validate([
            'content' => 'required|min:5|max:250'
        ]);
        $idea->content = $request->input('content');
        $idea->save();
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea Sukses Diedit');
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
