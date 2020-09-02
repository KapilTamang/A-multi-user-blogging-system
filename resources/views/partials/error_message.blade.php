
@if(count($errors))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
   <h4 class="alert-heading">Please Fill The Form Correctly!</h4>
   <hr>
   @foreach($errors->all() as $error)
      <p style="color: red;"> {{ $error }} </p>
   @endforeach
   <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background-color: #fff;">
      <span aria-hidden="true" style="color: red;">&times;</span>
    </button>
 </div>
@endif