@if($errors->any())
    <div class="alert alert-danger">
       <ul>
           <button type="button" class="close" data-dismiss="alert">×</button>
           @foreach($errors->all() as $error)
              <li class="">{{$error}}</li>
           @endforeach
       </ul>
    </div>
@endif
