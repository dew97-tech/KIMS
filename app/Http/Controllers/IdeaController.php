<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Product;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::with('ideaProduct')->get();
        return view('pages.ideas.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sources = Product::where('type', 1)->get();
        $outcomes = Product::where('type', 2)->get();
        return view('pages.ideas.create', compact('sources', 'outcomes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Idea::create([
            'title' => $request['title'],
            'image' => $request['image'],
            'description' => $request['description'],
            'product' => $request['option_one'] ? $request['option_one'] : $request['option_two'],
        ]);

        return redirect()->route('ideas.index')->with('success', 'Idea Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idea = Idea::where('id', $id)->with('ideaProduct')->first();
        $sources = Product::where('type', 1)->get();
        $outcomes = Product::where('type', 2)->get();
        return view('pages.ideas.edit', compact('idea', 'sources', 'outcomes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idea = Idea::find($id);
        
        $idea->title = $request['title'];
        $idea->image = $request['image'];
        $idea->product = $request['option_one'] ? $request['option_one'] : $request['option_two'];
        $idea->description = $request['description'];

        $idea->save();

        return redirect()->route('ideas.index')->with('success', 'Idea Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idea = Idea::find($id);

        $idea->delete();

        return redirect()->route('ideas.index')->with('success', 'Idea Removed Successfully!');
    }

    public function generatedIdeas($product_id)
    {
        $ideas = Idea::where('product', $product_id)->with('ideaProduct')->get();
        return $ideas;
    }
}
