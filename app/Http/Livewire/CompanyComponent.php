<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;


class CompanyComponent extends Component
{
    use WithFileUploads;

    protected $listeners=['companyCreated'=>'$refresh'];

    public $name,$description,$address,$picture;
    public $uName,$uDescription,$uAddress,$company_picture;
    public $myId;

    public function render()
    {
        $myCompany=Company::find($this->myId);
        if(isset($this->company_picture)){
            $company=Company::where('id',Auth::id())->first();
            $company->picture=$this->company_picture->hashName();
            $company->save();
            //$this->company_picture->store('public/photos');
            $this->company_picture->store('/company_pictures', ['disk' => 'my_files']);
            unset($this->company_picture);
            $this->emit('companyCreated');
            $this->emitTo('post-component','postsUpdated');
        }
        return view('livewire.company-component',compact('myCompany'));
    }
    public function createCompany(){
        $this->validate([
            'name'=>'string|max:30|required',
            'description'=>'string|max:250|required',
            'address'=>'string|max:30|required',
            'picture' => 'image|max:10240|required'
        ]);
        $company=new Company;
        $company->id=Auth::id();
        $company->name=$this->name;
        $company->description=$this->description;
        $company->address=$this->address;
        $company->picture=$this->picture->hashName();
        $company->save();
        if(!empty($this->picture)){
            $this->picture->store('/company_pictures', ['disk' => 'my_files']);
        }
        $this->emit('companyCreated');
    }
    public function assignCompany()
    {
        $myCompany=Company::find(Auth::id());
        $this->uName=$myCompany->name;
        $this->uDescription=$myCompany->description;
        $this->uAddress=$myCompany->address;
    }
    public function updateCompany(){
        $this->validate([
            'uName'=>'string|max:30|required',
            'uDescription'=>'string|max:500|required',
            'uAddress'=>'string|max:30|required',
        ]);
        $myCompany=Company::find(Auth::id());
        $myCompany->name=$this->uName;
        $myCompany->description= $this->uDescription;
        $myCompany->address= $this->uAddress;
        $myCompany->save();
        $this->emit('companyCreated');
    }
}
