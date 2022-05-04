<div>
        <div class="container mt-5">
        @if(isset($myCompany))
        <div class="row">
                        <div class="col-md-6 d-flex flex-column pers-info">
                                <div class="picture-container mt-2">
                                        <img src="{{asset('company_pictures/'.$myCompany->picture)}}" class="profile-picture"><span class="name">{{$myCompany->name.' Company'}}</span>
                                        @if($myCompany->id==Auth::id())
                                                <label for="company_picture" class="update-picture"><i class="fas fa-camera"></i></label>
                                                <input wire:model="company_picture" type="file" id="company_picture" class="d-none">
                                        @endif
                                </div>
                                <div class="">
                                        <h3><span>.</span>Company Info @if($myCompany->id==Auth::id()) <i class="fas fa-edit text-primary float-right" wire:click="assignCompany" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editCompanyModal"></i> @endif</h3>
                                        <p class="ml-5  mt-5"><i class="fas fa-building text-primary"></i> {{$myCompany->name}}</p>
                                        <p class="ml-5  mt-1"><i class="fas fa-map-marker-alt text-primary"></i> {{$myCompany->address}}</p>
                                </div>

                        </div>
                        <div class="col-md-6 bg-white">
                                <div>
                                        <h1 class="f-header">About Company</h1>
                                        <p>
                                                {{$myCompany->description}}
                                        </p>
                                </div>
                        </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                        <h3 class="text-center">Company Jobs</h3>
                        <hr class="w-25 bg-dark">
                </div>
                <div class="col-md-12">
                        <livewire:post-component :filter="$myCompany->id"></livewire:post-component>
                </div>
        </div>
        @else
                       <div class="d-flex flex-column justify-content-center align-items-center " style="min-height:500px">
                                <p class="text-muted">You Don't Have Any Company Create One Now</p>
                                <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Create Company +</button>
                       </div>
        @endif
        </div>

<!-- Edit Company Modals -->
        @if(Auth::check())
        @if(Auth::user()->myCompany != null)
            <div wire:ignore.self class="modal fade mt-5" id="editCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Company</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" wire:model="uName" class="form-control"  placeholder="Enter Company Name">
                                    @error('uName') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="description">Description</label>
                                    <textarea id="description" wire:model="uDescription" class="form-control" placeholder="Enter Company Description"></textarea>
                                    @error('uDescription') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" wire:model="uAddress" class="form-control" placeholder="Enter Company Address">
                                    @error('uAddress') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button wire:click="updateCompany" class="btn btn-primary pl-5 pr-5">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
        @endif
<!-- Modals -->

        <div wire:ignore.self class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                        <div class="col-md-12 mb-2">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" wire:model="name" class="form-control" placeholder="Enter Company Name">
                                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-12 mb-2">
                                                <label for="description">Description</label>
                                                <textarea id="description" wire:model="description" class="form-control" placeholder="Enter Company Description"></textarea>
                                                @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-12 mb-2">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" wire:model="address" class="form-control" placeholder="Enter Company Address">
                                                @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-12 mb-2">
                                                <label for="picture">Profile Picture</label>
                                                <input type="file" id="picture" wire:model="picture" class="form-control">
                                                <div wire:loading wire:target="picture">Uploading...</div>
                                                @error('picture') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-12 mt-3">
                                                <button wire:click="createCompany" class="btn btn-primary pl-5 pr-5">Create</button>
                                        </div>
                                </div>
                        </div>
                        </div>
                </div>
        </div>


</div>
