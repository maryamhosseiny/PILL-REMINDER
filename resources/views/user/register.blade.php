@extends('layouts.site')
@section('content')
    <form method="post" id="form">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password_repeat" class="form-label">Password Repeat</label>
            <input type="password" class="form-control" id="password_repeat" name="password_repeat">
        </div>
        <button type="button" class="btn btn-primary" id="btn-login">Register</button>
    </form>
@endsection


@push('scripts')
    <script>
        let base_url = '<?= url('/api')  ?>';
        $(document).ready(function () {

            $("#btn-login").on("click", function (event) {
                let name = $('#name').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let password_repeat = $('#password_repeat').val();
                $.post(base_url + "/user/register", {name,email,password,password_repeat})
                    .done(function (response) {
                        console.log(response);
                        if(response.success)
                        {
                            window.localStorage.setItem('token',response.data.token);
                            window.location = '{{url('/dashboard')}}';
                        }
                        else
                        {
                            alert(response.message);
                        }
                    });
                event.preventDefault();
            });
        });

    </script>
@endpush
