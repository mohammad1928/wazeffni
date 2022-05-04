<div>
    <div class="">
        <input wire:model="search" type="search" placeholder="Search by user ID or username " class="form-control mb-2 w-30">
    </div>
    <div style="overflow: auto">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Address</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($users as $user )
                    <tr>
                        <td>{{ $user->fname }}</td>
                        <td>{{ $user->lname }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->birthdate }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->email }}</td>
                       <td>
                            <button wire:click="assignUser({{ $user->id }})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</button>
                            <button wire:click="assignUser({{ $user->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal">Delete</button>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<!-- Delete User Modal -->
    <div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            Do you want to delete this user ?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button wire:click="deleteUser()" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit User Modal --}}
    <div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <form wire:submit.prevent="editUser()" class="">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input wire:model="email" id="email" type="text" class="form-control">
                                    @error('email')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input wire:model="password" id="password" type="password" class="form-control">
                                    @error('password')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                               
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                    </div>
            </div>
        </div>
    </div>
    

</div>
