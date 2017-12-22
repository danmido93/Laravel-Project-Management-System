@extends('layouts.app')
@section('content')

<div class="row row col-md-12 col-lg-12 col-sm-12">

    <div class="row col-md-9 col-lg-9 col-sm-9 pull-left ">

        <div class="well well-lg" style="background: white; margin: 2px;">
        {{'project_id '.$project->id}}</br>
        {{'user_id '.$project->user_id}}
            <h1>{{ $company->name }}</h1>
           
            <h2>{{ $project->name }}</h2>

            <p class="lead">{{ $project->description }}</p>

            @if($project->days === null)  

                <p class="lead" hidden >{{ $project->days }} day project</p>

            @endif 

            @if($project->days != null)  

                <p class="lead" >{{ $project->days }} day project</p>
                
            @endif       
          
        </div>
        
        <!--Add Comment button -->
         <!--<a href="/comments/create/{{ $project->id }}" style="margin-top: 7px;" class="pull-right btn btn-primary btn-sm">Add Comment</a>-->

        </br> 
        </br> 

        <!--Add Comment button -->

        <!-- Comments Form -->

        <div class="row container-fluid" style="background: white; margin: 2px;" >
        
            <form method="post" action="{{ route('comments.store') }}">

                         {{ csrf_field() }}

                <div class="form-group">

                    <label for="company">Body*</label>

                    <textarea placeholder="Enter Comment" style="resize: vertical" id="comment-content" name="body" rows="5"spellcheck="false" class="form-control autosize-target text-left"></textarea>

                </div>

                <div class="form-group">

                    <label  for="url"><span class="required">Proof of work done (url/photos)</span></label>

                     <textarea placeholder="Enter link"  style="resize: vertical" id="comment-content" name="url" rows="1" spellcheck="false" class="form-control autosize-target text-left"></textarea>

                </div>
                
                <!-- Comments hidden fields -->
                <input type="hidden" name="commentable_type" value="App\Project">

                <input type="hidden" name="commentable_id"  value="{{ $project->id }}">
                 <!-- Comments hidden fields -->

                 <div class="form-group">

                    <input type="submit" class="btn btn-primary" value="Submit"/>

                </div>
                                   
            </form>
       
        </div>

         <!-- Comments Form -->
    </div>

   

<!-- side bar menu -->

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
       
        <div class="sidebar-module">

            <h4>Actions</h4>

            <ol class="list-unstyled">

                <li><a href="/projects/create">Add Project</a></li>

                <li><a href="/projects/{{$project->id}}/edit">Edit Project</a></li>

                <li><a href="/projects">All projects</a></li>
              
                
                @if($project->user_id === Auth::user()->id)

                <li>
                    <a   
                    href="#" onclick=" 

                        var result = confirm('Are you sure you wish to delete this project?');

                            if( result ){

                                event.preventDefault();

                                document.getElementById('delete-form').submit();
                            }
                    " style="color: red;" >Delete</a>

                    <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" method="POST" style="display: none;">

                        <input type="hidden" name="_method" value="delete">

                            {{ csrf_field() }}
                    </form>
                  
                </li>

                @endif 

            </ol>
            <br/>
            
            <!-- Add members -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ol-xs-12">
                    <h5>Add Members to Project</h5>
                    <div class="input-group">

                         <form id="add-user" method="POST" action="{{ route('projects.adduser') }}">

                            {{ csrf_field() }}

                            <div class="input-group">
                                
                                <input type="hidden" name="project_id" value="{{$project->id}}" class="form-control">

                                <span class="input-group-btn">Go!
                                    <button style="border-color: lightgray;" type="submit" class="btn btn-default">Add!</button>
                                </span><input type="text" name="email" required autofocus class="form-control" placeholder="Email" aria-label="Search for...">
                               
                            </div>
                                
                        </form>
 
                    </div>
                        <br/>
                    <div>
                        
                        <h5>Team Members</h5>

                        <ol class="list-unstyled">
                            
                            @foreach($project->users as $user)

                                <li><a>{{ $user->email }}</a></li>

                            @endforeach

                        </ol>

                    </div>

                </div>

            </div>  
             <!-- Add members -->
     </div>
</div>
<!-- side bar menu -->                   


@include('partials.comments.comments')


@endsection


