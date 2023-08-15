<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!---------------------------------------- Custom CSS Link --------------------------------------->

    <link rel="stylesheet" href="{{ asset('profile/temp_one/css/style.css') }}" />

    <!--------------------------------------- Font Awesome CDN --------------------------------------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <title>Template One </title>
</head>

<body>
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-5 p-0">
                    <div class="background-pink">
                        <div class="pt-5 d-flex justify-content-center">
                            <div class="profile-image">
                                <img src="{{ asset(isImageExist($userDetails['photo'])) }}" class="img-fluid"
                                    alt="" />
                            </div>
                        </div>
                        <h5 class="text-center text-color-pink pt-2">{{ $userDetails['name'] }}</h5>
                        <h6 class="text-center px-5 text-color-pink py-3">
                            {{ $userDetails['job_title'] }} at
                            {{ $userDetails['company'] }}
                        </h6>

                        <div class="mx-3 my-4">
                            <a href="{{ route('add.contact', $userDetails['user_id']) }}"
                                class="btn w-100 bg-white d-flex justify-content-center gap-2 py-3">
                                <i class="fa fa-heart text-danger mt-1" aria-hidden="true"></i>
                                <h6 class="fw-bold">
                                    Save Contact
                                </h6>
                                <i class="fa fa-heart text-danger mt-1" aria-hidden="true"></i>
                            </a>
                        </div>
                        {{-- <div class="social-icons d-flex justify-content-center gap-5 py-4">
                            <a href="#">
                                <i class="fa fa-facebook text-color-pink fs-3" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-twitter text-color-pink fs-3" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-instagram text-color-pink fs-3" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-snapchat-ghost text-color-pink fs-3" aria-hidden="true"></i>
                            </a>
                        </div> --}}

                        @for ($i = 0; $i < count($userPlatforms); $i++)
                            {{-- <div class="px-4 py-2">
                                <button class="btn bg-white btn-bg-colors position-relative w-100 py-3 fw-bold">
                                    {{ $userPlatforms[$i]->label }}
                                    <img src="{{ asset(isImageExist($userPlatforms[$i]->icon)) }}"
                                        class="img-fluid social-image position-absolute btn-icon" alt="">
                                </button>
                            </div> --}}
                            <div class="px-4 py-2">
                                <button class="btn bg-pink position-relative w-100 text-white rounded-pill py-2">
                                    {{ $userPlatforms[$i]->label }}
                                    <img src="{{ asset(isImageExist($userPlatforms[$i]->icon)) }}"
                                        class="img-fluid social-image position-absolute btn-icon" alt="">
                                    {{-- <i class="fa fa-instagram text-white fs-3 position-absolute btn-icon"></i> --}}
                                </button>
                            </div>
                        @endfor

                        {{-- <div class="px-4">
                            <button class="btn bg-pink position-relative w-100 text-white rounded-pill py-2">Instagram
                                <i class="fa fa-instagram text-white fs-3 position-absolute btn-icon"></i>
                            </button>
                        </div>
                        <div class="px-4 my-3">
                            <button class="btn bg-pink position-relative w-100 text-white rounded-pill py-2">Facebook
                                <i class="fa fa-facebook text-white fs-3 position-absolute btn-icon"></i>
                            </button>
                        </div>
                        <div class="px-4 my-3">
                            <button class="btn bg-pink position-relative w-100 text-white rounded-pill py-2">Twitter
                                <i class="fa fa-twitter text-white fs-3 position-absolute btn-icon"></i>
                            </button>
                        </div>
                        <div class="px-4 pb-5">
                            <button class="btn bg-pink position-relative w-100 text-white rounded-pill py-2">Snapchat
                                <i class="fa fa-snapchat-ghost text-white fs-3 position-absolute btn-icon"></i>
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
