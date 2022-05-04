<div>
    <div>
        <div class="">
            <input wire:model="search" type="search" placeholder="Search by company name " class="form-control mb-2 w-30">
        </div>
        <div style="overflow: auto">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Picture</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($companies as $company )
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td><a href="/profile/{{ $company->user->id }}">{{ $company->user->fname.' '.$company->user->lname }}</a></td>
                            <td>{{ $company->description }}</td>
                            <td>{{ $company->address }}</td>
                            <td>{{ $company->created_at }}</td>
                            <td>
                                <img src="{{ asset('company_pictures/'.$company->picture) }}" width="50" height="50" alt="Company picture">
                            </td>
                           <td>
                                <button wire:click="assignCompany({{ $company->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCompanyModal">Delete</button>
                            </td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    <!-- Delete User Modal -->
        <div wire:ignore.self class="modal fade" id="deleteCompanyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Company</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                Do you want to delete this company ?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="deleteCompany()" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    
       
    
    </div>
    
</div>
