@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('includes.errors-message')
    <section class="row new-post">
         <div class="col-md-6 col-md-offset-3">
             <header>
                 <h3>What do you have to say?</h3>
             </header>
             <form action="{{ route('post.create') }}" method="post">
                 <div class="form-group">
                     <textarea name="body" id="new-post" placeholder="New post" cols="30" rows="5" class="form-control"></textarea>
                 </div>
                 <input type="hidden" name="_token" value="{{ Session::token() }}">
                 <button class="btn btn-primary" type="submit">Create Post</button>
             </form>
         </div>
     </section>
 
 <section class="row posts">
     <div class="col-md-6 col-md-offset-3">
         <header>
             <h3>What other people say...</h3>
         </header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                         Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                        <a href="#">Like</a> | 
                        <a href="#">Dislike</a>
                        
                        @if(Auth::user() == $post->user)
                            | <a class="edit" href="">Edit</a>
                            | <a href="{{ URL::to('/delete-post', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                         
                    </div>
                </article>
            @endforeach
         
     </div>
 </section>
 

    <!-- Edit Model -->
    
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Post</h4>
          </div>
          <div class="modal-body">
            <form action="" method="">
                <div class="form-group">
                    <label for="post-body">Edit the Post</label>
                    <textarea class="form-control" name="post-body" id="post-body" cols="30" rows="5"></textarea>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="model-save">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    
    <script>
        var token = '{{ Session::token() }}';
        var url = '{{ route('edit') }}'
    </script>
@endsection


