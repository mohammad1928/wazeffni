<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class AddJobComponent extends Component
{
    public $jobTitle,$category,$description,$city,$reqSkills,$minSalary,$maxSalary;
    public function render()
    {
        
        return view('livewire.add-job-component');
    }
    public function addJob(){
       $post=new Post();
       $post->company_id=Auth::user()->myCompany->id;
       $post->job_title=$this->jobTitle;
       $post->category=$this->category;
       $post->city=$this->city;
       $post->description=$this->description;
       $post->requirements_skills=$this->reqSkills;
       $post->minSalary=$this->minSalary;
       $post->maxSalary=$this->maxSalary;
       $post->save();
       session(['success'=>'Job was added successfully.']);
       
    }
    public function clearSession()
    {
        session()->forget('success');
    }
}
