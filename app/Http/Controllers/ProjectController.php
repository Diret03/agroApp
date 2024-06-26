<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Responsible;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $responsibles = Responsible::all();
        $projects = Project::all();
        return view('projects.index', compact('projects', 'responsibles'));
    }

    public function create()
    {
        $responsibles = Responsible::all();
        return view('projects.create', compact('responsibles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required',
            'progress_percentage' => 'required|numeric',
            'responsible_id' => 'required|exists:responsibles,id'
        ]);

        Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $responsibles = Responsible::all();
        return view('projects.edit', compact('project', 'responsibles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required',
            'progress_percentage' => 'required|numeric',
            'responsible_id' => 'required|exists:responsibles,id'
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
