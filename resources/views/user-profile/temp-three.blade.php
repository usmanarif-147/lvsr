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

    <link rel="stylesheet" href="{{ asset('profile/temp_three/css/style.css') }}" />

    <!--------------------------------------- Font Awesome CDN --------------------------------------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <title>Template Three</title>
</head>

<body>
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-5 p-0">
                    <div class="background-green">
                        <div class="pt-5 d-flex justify-content-center">
                            <div class="profile-image">
                                <img src="{{ asset(isImageExist($userDetails->photo)) }}" class="img-fluid"
                                    alt="" />
                            </div>
                        </div>
                        <h5 class="text-center text-white pt-2">{{ $userDetails->name }}</h5>
                        <h6 class="text-center px-5 text-white py-3">
                            {{ $userDetails->job_title }} at
                            {{ $userDetails->company }}
                        </h6>

                        <div class="mx-3 my-4">
                            <a href="{{ route('add.contact', $userDetails->user_id) }}"
                                class="btn w-100 bg-white d-flex justify-content-center gap-2 py-3">
                                <i class="fa fa-heart text-danger mt-1" aria-hidden="true"></i>
                                <h6 class="fw-bold">
                                    Save Contact
                                </h6>
                                <i class="fa fa-heart text-danger mt-1" aria-hidden="true"></i>
                            </a>
                        </div>

                        @for ($i = 0; $i < count($userPlatforms); $i++)
                            <div class="px-4 py-2">
                                <button
                                    class="btn bg-white position-relative w-100 py-3 fw-bold text-primary rounded-pill">
                                    {{ $userPlatforms[$i]->label }}
                                    <img src="{{ asset(isImageExist($userPlatforms[$i]->icon)) }}"
                                        class="img-fluid social-image position-absolute btn-icon" alt="">
                                </button>
                            </div>
                        @endfor

                        {{-- <div class="px-4">
                            <button
                                class="btn bg-white position-relative w-100 py-3 fw-bold text-primary rounded-pill">Facebook
                                - Account
                                <img src="{{ asset('profile/temp_three/images/facebook.png') }}"
                                    class="img-fluid social-image position-absolute btn-icon" alt="">
                            </button>
                        </div>
                        <div class="px-4 my-3">
                            <button
                                class="btn bg-white position-relative w-100 py-3 fw-bold text-primary rounded-pill">Instagram
                                - Account
                                <img src="{{ asset('profile/temp_three/images/facebook.png') }}"
                                    class="img-fluid social-image position-absolute btn-icon" alt="">
                            </button>
                        </div>
                        <div class="px-4 my-3">
                            <button
                                class="btn bg-white position-relative w-100 py-3 fw-bold text-primary rounded-pill">Twitter
                                - Account
                                <img src="{{ asset('profile/temp_three/images/facebook.png') }}"
                                    class="img-fluid social-image position-absolute btn-icon" alt="">
                            </button>
                        </div>
                        <div class="px-4 pb-5">
                            <button
                                class="btn bg-white position-relative w-100 py-3 fw-bold text-primary rounded-pill">Linkeidn
                                - Account
                                <img src="{{ asset('profile/temp_three/images/facebook.png') }}"
                                    class="img-fluid social-image position-absolute btn-icon" alt="">
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
