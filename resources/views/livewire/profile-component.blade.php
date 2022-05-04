<div>
        <div class="container mt-5 p-4">
                <div class="row">
                        <div class="col-md-6 d-flex flex-column pers-info">
                                <div class="picture-container mt-2">
                                        <img src="{{asset('profile_pictures/'.$user->profile_picture)}}" class="profile-picture"><span class="name">{{$user->fname.' '.Auth::user()->lname}}</span>
                                        @if($user->id==Auth::id())
                                                <label for="profile-picture" class="update-picture"><i class="fas fa-camera"></i></label>
                                                <input wire:model="picture" type="file" id="profile-picture" class="d-none">
                                        @endif
                                </div>
                                <div class="">
                                        <h3><span>.</span>contacts @if($user->id==Auth::id())<i class="fas fa-edit text-primary float-right" wire:click="setModel('contacts')" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editModal"></i> @endif</h3>
                                        <p class="ml-5  mt-5"><i class="fas fa-phone text-primary"></i> {{$user->phone_number}}</p>
                                        <p class="ml-5  mt-1"><i class="fas fa-envelope text-primary"></i> {{$user->email}}</p>
                                        <p class="ml-5  mt-1"><i class="fas fa-map-marker text-primary"></i> {{$user->address}}</p>
                                        <p class="ml-5  mt-1"><i class="fas fa-globe-americas text-primary"></i> <a href="https://{{$user->website}}">{{$user->website}}</a> </p>
                                </div>
                                <div class="">
                                        <h3><span>.</span>Languages @if($user->id==Auth::id())<i class="fas fa-edit text-primary float-right" wire:click="setModel('languages')" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editModal"></i> @endif</h3>
                                        @foreach($user->myLanguages as $language)
                                                <div class="language-container">
                                                        <div class="my-progress ml-5 mt-5"><div class="p-percentage" style="width:{{$language->profisiency_ratio}}%">{{$language->language}}</div></div>
                                                        <span class="delete" wire:click="deleteLanguage({{$language->id}})">@if($user->id==Auth::id())<i class="fas fa-times text-muted"></i>@endif</span>
                                                </div>
                                        @endforeach

                                </div>
                                <div class="">
                                        <h3><span>.</span>skills @if($user->id==Auth::id()) <i class="fas fa-edit text-primary float-right" wire:click="setModel('skills')" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editModal"></i> @endif</h3>
                                        @foreach($user->mySkills as $skill)
                                                <p class="ml-5  mt-4"> <i class="fas fa-circle text-primary"></i> {{$skill->skill}} <span class="float-right" wire:click="deleteSkill({{$skill->id}})"> @if($user->id==Auth::id()) <i class="fas fa-times text-muted"></i> @endif</span></p>
                                        @endforeach
                                </div>
                        </div>
                        <div class="col-md-6 bg-white">
                                <div>
                                        <h1 class="f-header">About Me @if($user->id==Auth::id())<i class="fas fa-edit text-primary float-right" wire:click="setModel('aboutme')" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editModal"></i> @endif</h1>
                                        <p class="text-muted">
                                                {{$user->about_me}}
                                        </p>
                                </div>
                                <div class="mt-5">
                                        <h1 class="">education @if($user->id==Auth::id()) <i class="fas fa-edit text-primary float-right" wire:click="setModel('education')" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editModal"></i> @endif</h1>
                                        @foreach($user->myEducation as $education)
                                                <h5 class="ml-2 mt-4"><i class="fas fa-circle text-primary"></i> {{$education->source}} <span class="float-right" wire:click="deleteEducation({{$education->id}})">@if($user->id==Auth::id())<i class="fas fa-times text-muted"></i>@endif</span></h5>
                                                <p class="text-muted ml-4 mb-2">{{$education->description}}</p>
                                        @endforeach
                                </div>
                                <div class="mt-5">
                                        <h1 class="">experience @if($user->id==Auth::id()) <i class="fas fa-edit text-primary float-right" wire:click="setModel('experience')" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editModal"></i> @endif</h1>
                                        @foreach($user->myExperience as $experience)
                                                <h5 class="ml-2 mt-4"><i class="fas fa-circle text-primary"></i> {{$experience->worked_for}} <span class="float-right" wire:click="deleteExperience({{$experience->id}})">@if($user->id==Auth::id())<i class="fas fa-times text-muted"></i>@endif</span></h5>
                                                <p class="text-muted ml-5 mb-2">{{$experience->caption}}</p>
                                        @endforeach
                                </div>
                                <div class="mt-5">
                                        <h1 class="">hobbies @if($user->id==Auth::id()) <i class="fas fa-edit text-primary float-right" wire:click="setModel('hobbies')" style="font-size:25px;cursor:pointer" data-toggle="modal" data-target="#editModal"></i> @endif</h1>
                                        @if($user->hobbies!=null)
                                                <p class="ml-3  mt-4"><i class="fas fa-circle text-primary"></i> {{$user->hobbies}} </p>
                                        @endif
                                </div>
                        </div>
                </div>
        </div>


        <!--Edit Modal-->
        <div wire:ignore.self class="modal fade mt-5" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                                @if($model=="contacts")
                                <div class="row">
                                        <div class="col-md-12 mb-2">
                                                <label for="phone">Phone</label>
                                                <input id="phone" type="number" wire:model="phone" class="form-control"  placeholder="Enter Your Phone Number">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                                <label for="email">Email</label>
                                                <input id="email" type="email" wire:model="email" class="form-control"  placeholder="Enter Your Email">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                                <label for="address">Address</label>
                                                <input id="address" type="text" wire:model="address" class="form-control"  placeholder="Enter Your Address">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                                <label for="website">Website</label>
                                                <input id="website" type="text" wire:model="website" class="form-control"  placeholder="Enter Your Website Link">
                                        </div>
                                        <div class="col-md-12">
                                                <button wire:click="editContact" class="btn btn-primary">Save</button>
                                        </div>
                                </div>
                                @elseif($model=="languages")
                                        <div class="row">
                                                <div class="col-md-12 mb-2">
                                                        <label for="language">Language</label>
                                                        <input id="language" type="text" wire:model="language" class="form-control"  placeholder="Enter Your Language Name">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                        <label for="profisiency_ratio">Profisiency Ratio</label>
                                                        <input id="profisiency_ratio" type="number" wire:model="profisiency_ratio" class="form-control"  placeholder="Enter Your Language Profisiency">
                                                </div>
                                                <div class="col-md-12">
                                                        <button wire:click="addLanguage" class="btn btn-primary">Save</button>
                                                 </div>
                                        </div>
                                @elseif($model=="skills")
                                        <div class="row">
                                                <div class="col-md-12 mb-2">
                                                        <label for="skill">Skill</label>
                                                        <input id="skill" type="text" wire:model="skill" class="form-control"  placeholder="Enter Your Skill">
                                                </div>
                                                <div class="col-md-12">
                                                        <button wire:click="addSkill" class="btn btn-primary">Add</button>
                                                 </div>
                                        </div>
                                @elseif($model=="aboutme")
                                        <div class="row">
                                                <div class="col-md-12 mb-2">
                                                        <label for="aboutme">About Me</label>
                                                        <textarea id="skill" wire:model="aboutme" class="form-control"  placeholder="Enter Caption About You."></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                        <button wire:click="editAboutMe" class="btn btn-primary">Update</button>
                                                </div>
                                        </div>
                                @elseif($model=="education")
                                        <div class="row">
                                                <div class="col-md-12 mb-2">
                                                        <label for="education">Education</label>
                                                        <input id="education" type="text" wire:model="education" class="form-control"  placeholder="Enter Your Education">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                        <label for="caption">Caption About The Source</label>
                                                        <input id="caption" type="text" wire:model="caption" class="form-control"  placeholder="Enter Caption About This Education">
                                                </div>
                                                <div class="col-md-12">
                                                        <button wire:click="addEducation" class="btn btn-primary">Add</button>
                                                </div>
                                        </div>
                                @elseif($model=="experience")
                                        <div class="row">
                                                <div class="col-md-12 mb-2">
                                                        <label for="worked_for">Worked For</label>
                                                        <input id="worked_for" type="text" wire:model="worked_for" class="form-control"  placeholder="Enter The Company Name You Worked For">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                        <label for="caption">Caption About The Source</label>
                                                        <input id="caption" type="text" wire:model="exp_caption" class="form-control"  placeholder="Enter Caption About Your Work in This Company">
                                                </div>
                                                <div class="col-md-12">
                                                        <button wire:click="addExperience" class="btn btn-primary">Add</button>
                                                </div>
                                        </div>
                                @else
                                        <div class="row">
                                                <div class="col-md-12 mb-2">
                                                        <label for="hobbies">Hobbies</label>
                                                        <textarea id="hobbies"  wire:model="hobbies" class="form-control"  placeholder="Like: Programming, Football, Writing, ....etc"></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                        <button wire:click="addHobbies" class="btn btn-primary">Update</button>
                                                </div>
                                        </div>
                                @endif
                        </div>
                        </div>
                </div>
        </div>


</div>
