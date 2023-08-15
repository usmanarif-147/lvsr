<section>
    <nav class="navbar navbar-expand-lg bg-white fixed-top border-bottom shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('welcome/images/LVSR Logo.svg') }}" class="img-fluid logo" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#works">How it works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#faqs">FAQs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
