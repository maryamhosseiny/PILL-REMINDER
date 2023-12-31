@include('layouts/_head')
<body>
<div class="container">
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('/register')}}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('/login')}}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="mt-4 p-5 bg-primary text-white rounded">
        <h1>Take your medications. Off your mind.</h1>
        <p> Your personal pill reminder and medication tracker </p>
    </div>
@yield('content')

</div>
@stack('scripts')
</body>
@include('layouts/_footer')

