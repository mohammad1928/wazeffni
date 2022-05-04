<?php

namespace App\Http\Livewire\Admin;
use App\Models\Company;
use Livewire\Component;

class ManageCompanies extends Component
{
    public $search,$companyId;
    public function render()
    {
        if(isset($this->search))
        {
            $companies=Company::where('name','like','%'.$this->search.'%')->get();
        }
        else
        {
            $companies=Company::paginate(10);
        }
        
        return view('livewire.admin.manage-companies',compact('companies'));
    }

    public function assignCompany($companyId)
    {
        $this->companyId=$companyId;
    }

    public function deleteCompany()
    {
        Company::find($this->companyId)->delete();
    }
}
