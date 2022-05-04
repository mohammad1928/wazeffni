<div>
    
    <div class="container mt-5 p-3 d-flex justify-content-center">
    @if(Auth::user()->myCompany !=null)
        <div class="card w-50" style="">
            <h4 class="card-header">Add a New Job</h4>
            <div class="card-body">
                <div class="row">
                    @if(session('success')!=null)
                        <div class="alert alert-success w-100 text-center">{{ session('success') }} <span wire:click='clearSession' class="float-right" style="cursor: pointer">&times;</span></div>
                    @endif
                        <div class="col-md-12 mb-3">
                            <label for="job-title">Job Title</label>
                            <input id="job-title" type="text" wire:model="jobTitle" class="form-control" placeholder="Enter Job Title"> 
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="category">Category</label>
                            <select wire:model="category" class="form-control">
                                        <option value="IT">IT</option>
                                        <option value="calculating">Calculating</option>
                                        <option value="construction">Construction</option>
                                        <option value="education">Teacher</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="city">City</label>
                            <select id="city" wire:model="city" class="form-control">
                                    <option value="Hama">Hama</option>
                                    <option value="Homs">Homs</option>
                                    <option value="Idleb">Idleb</option>
                                    <option value="Damascus">Damascus</option>
                                    <option value="Aleppo">Aleppo</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="desc">Description</label>
                            <pre><textarea id="desc" wire:model="description" class="form-control" placeholder="Type Job Description"></textarea></pre>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="reqSkills">Requirement Skills <span class="text-muted">({{"Style it as you want"}})</span></label>
                            <textarea id="reqSkills" wire:model="reqSkills" class="form-control" placeholder="Type Job Requirement Skills"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="min-salary">Min Salary</label>
                            <input id="min-salary" type="number" wire:model="minSalary" class="form-control" placeholder="Enter Minimum Job Salary"> 
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="max-salary">Max Salary</label>
                            <input id="max-salary" type="number" wire:model="maxSalary" class="form-control" placeholder="Enter Maximum Job Salary"> 
                        </div>
                        <div class="col-md-12 mt-4">
                            <button wire:click="addJob()" class="btn btn-primary form-control">Post Job</button>
                        </div>
                    </div>
                </div>
        </div>
    @else
        <div class="d-flex justify-content-center align-items-center" style="height:500px">
            <p>You Don't Have Company Please <a href="/company/{{Auth::id()}}">Create Company</a> and Try Again</p>
        </div>
    @endif
    </div>
    
</div>
