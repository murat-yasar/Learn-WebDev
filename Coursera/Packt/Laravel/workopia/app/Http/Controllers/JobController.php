<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        $title = "Available Jobs";
        $jobs = [
            'Project Manager',
            'Frontend Developer',
            'UI/UX Designer',
            'Backend Developer',
            'QA Tester',
            'System Administrator'
        ];
        return view('jobs.index', compact('title', 'jobs'));
    }

    public function create(){
        return view('jobs.create');
    }
}
