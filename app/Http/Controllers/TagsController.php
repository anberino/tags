<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Tag;
use DB;

class TagsController extends Controller
{
    //
    public function index()
    {
        $tags = Tag::all();//->where('type', 'Acervo');
        return view('tag.index')->with('tags', $tags);
    }

    public function create() 
    {
        return view('tag.create');$tagVec[0];
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'nullable', 'category' => 'nullable', 'is' => 'nullable|exists:tags,name']);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->category = $request->category;
        $tag->type = 'Acervo';
        $equiv = Tag::where('name', $request->is)->first();
        $tag->is = 0;
        if ($equiv != null) { $tag->is = $equiv->id;}
        $tag->save();

        return redirect('/');
    }

    public function edit($id) 
    {
        $tag = Tag::find($id);
        $equiv = Tag::find($tag->is);
        $equivName = '';
        if($equiv != null) {$equivName = $equiv->name;}
        return view('tag.edit')->with('tagVec', [$tag, $equivName]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'nullable', 'category' => 'nullable', 'is' => 'nullable|exists:tags,name']);
        
        $tag = Tag::find($id);  
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->category = $request->category;
        $tag->type = 'Acervo';
        $equiv = Tag::where('name', $request->is)->first();
        if ($equiv != null) { $tag->is = $equiv->id;}
        else $tag->is = 0;
        $tag->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        TagsController::purge($id);
        return redirect('/');
    }

    public function purge($id) //actually destroys stuff - recursively
    {
        $tag = Tag::find($id);
        foreach(Tag::where('is', $id)->get() as $dependancies) //recursively destroys all equivalent terms
        {
            TagsController::purge($dependancies->id);
        }
        $tag->delete();
        return;
    }
}