@extends('layouts.app')

@section('content')
<button class="btn btn-primary" onclick="showAlert('Alert Demo')" style="margin: 20%">
    click
</button>
@endsection

<script>
    function showAlert(msg) {
        var msg = msg;
        const Toast = Swal.mixin({
  toast: true,
  position: 'center',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

Toast.fire({
  icon: 'success',
  title: 'Your blog has been published successfully'
});
    }
</script>