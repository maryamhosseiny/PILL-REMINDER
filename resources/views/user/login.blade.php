@extends('layouts.login')
@section('content')
    <form method="post" id="form">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="button" class="btn btn-primary" id="btn-login">Login</button>
    </form>
@endsection


@push('scripts')
    <script>
        let base_url = '<?= url('/api')  ?>';
        $(document).ready(function () {

            $("#btn-login").on("click", function (event) {
                let email = $('#email').val();
                let password = $('#password').val();
                $.post(base_url + "/user/login", {email,password})
                    .done(function (response) {
                        console.log(response);
                        if(response.success)
                        {
                            window.localStorage.setItem('token',response.data.token);
                            window.location ='/dashboard';
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
