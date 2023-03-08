<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project;
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects',
            'content' => 'required|string',
            'image' => 'nullable|url'
        ],[
                'title.required' => 'il titolo è obbligatorio',
                'title.unique' => "esiste già un progetto $request->title",
                'title.min' => 'il titolo deve avere almeno 5 caratteri',
                'title.max' => 'il titolo deve avere max 20 caratteri',
                'content.required' => 'il progetto deve avere un contenuto',
                'image.url' => 'link non valido',

        ]);
        $data = $request->all();

        $project = new Project();

        
        $project->fill($data);
        $project->slug = Str::slug($project->title, '-');
        
        $project->save();

        return to_route('admin.projects.index', $project->id)->with('type', 'success')->with('nuovo progetto creato');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required','string',Rule::unique('projects')->ignore($project->id)],
            'content' => 'required|string',
            'image' => 'nullable|url',],
            [
                'title.required' => 'il titolo è obbligatorio',
                'title.unique' => "esiste già un progetto $request->title",
                'title.min' => 'il titolo deve avere almeno 5 caratteri',
                'title.max' => 'il titolo deve avere max 20 caratteri',
                'content.required' => 'il progetto deve avere un contenuto',
                'image.url' => 'link non valido',

            ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        $project->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('msg', "Il progetto '$project->title' è stato eliminato")
        ->with('type','success');
    }
}
