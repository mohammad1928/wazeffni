<div>
    
    <div>
        <div class="">
            <input wire:model="search" type="search" placeholder="Search by report description " class="form-control mb-2 w-30">
        </div>
        <div style="overflow: auto">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <th>ID</th>
                    <th>User</th>
                    <th>Description</th>
                    <th>Reported At</th>
                    <th>Picture</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($reports as $report )
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td><a href="/profile/{{ $report->user->id }}">{{ $report->user->fname.' '.$report->user->lname }}</a></td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->created_at }}</td>
                            <td>
                                @if(isset($report->image))
                                    <img src="{{ asset('reports_pictures/'.$report->image) }}" width="50" height="50" alt="Company picture">
                                @endif
                            </td>
                           <td>
                                <button wire:click="assignReport({{ $report->id }},{{ $report->user->id }})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyReportModal">Reply</button>
                                <button wire:click="assignReport({{ $report->id }},{{ $report->user->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteReportModal">Delete</button>
                            </td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $reports->links() }}</div>
        </div>
    
    <!-- Delete User Modal -->
        <div wire:ignore.self class="modal fade" id="deleteReportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                Do you want to delete this report ?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="deleteReport()" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Report Modal -->
        <div wire:ignore.self class="modal fade" id="replyReportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Reply Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <form wire:submit.prevent="reply()">
                                    @csrf
                                    <div class="form-group">
                                        <label for="reply">Reply</label>
                                        <textarea wire:model="replyText" id="reply" class="form-control mb-2" placeholder="Write Reply...."></textarea>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                        </div>
                </div>
            </div>
        </div>
    
       
    
    </div>
    



</div>
