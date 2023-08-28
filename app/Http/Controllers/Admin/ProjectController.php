<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Technology;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin\Project;
use App\Models\Admin\Type;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => ['required', 'unique:projects', 'max:255'],
            'description' => ['min:10'],
            'date' => ['date'],
            'image' => ['image'],
            'type_id' => ['required', 'exists:types,id'],
            'technologies' => ['exists:technologies,id']
        ]);

        if ($request->hasFile('image')) {
            $img_path = Storage::put('uploads', $request->file('image'));
            $data['image'] = $img_path;
        }

        $data['slug'] = Str::of($data['title'])->slug('-');

        $newProject = Project::create($data);

        if($request->has('technologies')){
            $newProject->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {


        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'max:255', Rule::unique('projects')->ignore($project->id)],
            'description' => ['min:10'],
            'date' => ['date'],
            'image' => ['image'],
            'type_id' => ['required','exists:types,id'],
            'technologies' => ['exists:technologies,id']
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = Storage::put('uploads', $request['image']);
        }

        $data['slug'] = Str::of($data['title'])->slug('-');

        $project->update($data);
        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }
        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if(str_starts_with($project->image, "uploads")){

            Storage::move($project->image, 'deleted/' . basename($project->image));
        }
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    public function deletedIndex(){
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trashed', compact('projects'));
    }

    public function restore($id){
        $project = Project::onlyTrashed()->findOrFail($id);
        if (str_starts_with($project->image, 'uploads')){
            Storage::move('deleted/' . basename($project->image), 'uploads/' . basename($project->image));
        }
        $project->restore();
        return redirect()->route('admin.projects.show', $project);
    }

    public function hardDelete($id){
        $project = Project::onlyTrashed()->findOrFail($id);
        if (str_starts_with($project->image, 'uploads')){
            Storage::delete('deleted/' . basename($project->image));
        }

        $project->technologies()->detach();
        $project->forceDelete();

        return redirect()->route('admin.projects.deleted');
    }
}
