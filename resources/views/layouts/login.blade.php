@include('layouts/_head')
<body>
<div class="container">
    <div class="mt-4 p-5 bg-primary text-white rounded">
        <h1>Take your medications. Off your mind.</h1>
        <p> Your personal pill reminder and medication tracker </p>
    </div>
@yield('content')
</div>
@stack('scripts')
</body>
@include('layouts/_footer')

