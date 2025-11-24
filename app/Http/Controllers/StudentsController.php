<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Course;

class StudentsController extends Controller
{
    
    public function index()
    {

        $students = Students::with('course')->latest()->get();
        $courses = Course::all();
        $activeCourses = Course::count();

        return view('dashboard', compact('students', 'courses', 'activeCourses'));
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        Students::create($validated);

        return redirect()->back()->with('success', 'Student added successfully.');
    }

    
    public function update(Request $request, Students $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student->update($validated);

        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    
    public function destroy(Students $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }
}