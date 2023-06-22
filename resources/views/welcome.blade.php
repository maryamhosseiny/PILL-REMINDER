@extends('layouts.site')
@section('content')

<style>
    /* ===== Buttons Css ===== */
    .call-action-one .call-action-content .call-action-btn .primary-btn {
        background: var(--primary);
        color: var(--white);
        box-shadow: var(--shadow-2);
    }
    .call-action-one .call-action-content .call-action-btn .active.primary-btn, .call-action-one .call-action-content .call-action-btn .primary-btn:hover, .call-action-one .call-action-content .call-action-btn .primary-btn:focus {
        background: var(--primary-dark);
        color: var(--white);
        box-shadow: var(--shadow-4);
    }
    .call-action-one .call-action-content .call-action-btn .deactive.primary-btn {
        background: var(--gray-4);
        color: var(--dark-3);
        pointer-events: none;
    }

    /*===== call action one =====*/
    .call-action-one {
        background-color: var(--light-2);
        padding-top: 50px;
        padding-bottom: 100px;
    }
    .call-action-one .call-action-content .call-action-text {
        margin-top: 50px;
    }
    .call-action-one .call-action-content .call-action-text .action-title {
        font-weight: 600;
        color: var(--black);
    }
    .call-action-one .call-action-content .call-action-text .text-lg {
        color: var(--dark-3);
        margin-top: 16px;
    }
    .call-action-one .call-action-content .call-action-btn {
        margin-top: 50px;
    }
</style>
<section class="call-action-area call-action-one">
    <div class="container">
        <div class="row align-items-center call-action-content">
            <div class="col-xl-8 col-lg-8">
                <div class="call-action-text">
                    <h2 class="action-title">
                        Ready to create your Reminder <br /> now
                    </h2>
                    <a href="{{url('/register')}}" class="text-lg">
                        Register to Our Site
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="call-action-btn rounded-buttons text-lg-end">
                    <a href="{{url('/login')}}" class="btn primary-btn rounded-full">
                        Login Now
                    </a>
                </div>
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
@endsection
