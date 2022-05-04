<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Language;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ProfileComponent extends Component
{
    use WithFileUploads;

    protected $listeners=[
        'profileUpdated'=>'$refresh',
    ];

    public $model;
    public $picture,$phone,$email,$address,$website;
    public $language,$profisiency_ratio,$skill,$aboutme;
    public $education,$caption,$worked_for,$exp_caption,$hobbies;
    public $filter;

    public function render()
    {
        $user=User::find($this->filter);
        if(isset($this->picture)){
            $user=User::find(Auth::id());
            $user->profile_picture=$this->picture->hashName();
            $user->save();
            //$this->picture->store('public/profile_pictures');
            $this->picture->store('/profile_pictures', ['disk' => 'my_files']);
            unset($this->picture);
            $this->emit('profileUpdated');
        }
        
        return view('livewire.profile-component',compact('user'));
    }
    public function setModel($model){
        $this->model=$model;
        $user=User::find(Auth::id());
        $this->phone=$user->phone_number;
        $this->email=$user->email;
        $this->address=$user->address;
        $this->website=$user->website;
        $this->aboutme=$user->about_me;
        $this->hobbies=$user->hobbies;


    }
    public function editContact(){
        $user=User::find(Auth::id());
        $user->phone_number=$this->phone;
        $user->email=$this->email;
        $user->address=$this->address;
        $user->website=$this->website;
        $user->save();
        $this->emit('profileUpdated');       
    }
    public function addLanguage(){
        $language=new Language();
        $language->language=$this->language;
        $language->user_id=Auth::id();
        $language->profisiency_ratio=$this->profisiency_ratio;
        $language->save();
        $this->emit('profileUpdated');
    }
    public function addSkill(){
        $skill=new Skill();
        $skill->user_id=Auth::id();
        $skill->skill=$this->skill;
        $skill->save();
        $this->emit('profileUpdated');
    }
    public function editAboutMe(){
        $user=User::find(Auth::id());
        $user->about_me=$this->aboutme;
        $user->save();
        $this->emit('profileUpdated');
    }
    public function addEducation(){
        $education=new Education();
        $education->user_id=Auth::id();
        $education->source=$this->education;
        $education->description=$this->caption;
        $education->save();
        $this->emit('profileUpdated');
    }
    public function addExperience(){
        $experience=new Experience();
        $experience->user_id=Auth::id();
        $experience->worked_for=$this->worked_for;
        $experience->caption=$this->exp_caption;
        $experience->save();
        $this->emit('profileUpdated');
    }
    public function addHobbies(){
        $user=User::find(Auth::id());
        $user->hobbies=$this->hobbies;
        $user->save();
        $this->emit('profileUpdated');
    }

    public function deleteLanguage($id){
        Language::find($id)->delete();
        $this->emit('profileUpdated');
    }
    public function deleteSkill($id){
        Skill::find($id)->delete();
        $this->emit('profileUpdated');
    }
    public function deleteEducation($id){
        Education::find($id)->delete();
        $this->emit('profileUpdated');
    }
    public function deleteExperience($id){
        Experience::find($id)->delete();
        $this->emit('profileUpdated');
    }

}
