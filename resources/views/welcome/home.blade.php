@extends('welcome.layout')

@section('content')
    <!---------------------------------------- Hero Section Started ------------------------------------>

    <section class="hero-bg mt-5">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-12 col-md-6 pt-md-0 pt-5">
                    <h1 class="fw-bold  lh-sm pt-md-0 pt-5">Organize all your Social Media Content easily with this App.
                    </h1>
                    <p class="my-3">Simplify social media management. Streamline content organization, scheduling, and
                        engagement. Enhance your online presence with our user-friendly app..</p>

                </div>
                <div class="col-12 col-md-6">
                    <img src="/assets/images/hero-remove-bg.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <!----------------------------------------- Hero Section Ended ------------------------------------->

    <!--------------------------------------- About Section Started ------------------------------------>

    <section class="my-5" id="about">
        <div class="container">
            <div class="text-center">
                <h3 class="fw-bold">About</h3>
                <p>LVSR simplifies managing and sharing online presence. Customize your profile, share easily, and
                    connect <span class="divider"></span> with others seamlessly. Experience privacy and security
                    assurance.</p>
            </div>
            <div class="row d-flex justify-content-center align-items-center my-5">
                <div class="col-12 col-md-6">
                    <h4 class="fw-bold my-3">About Us</h4>
                    <p>LVSR is an innovative app and website for managing and sharing online presence. Create
                        personalized digital business cards with social media links and contact details. Choose from
                        stunning HTML templates for easy customization. Promote your online identity effortlessly
                        through QR codes, NFC, or direct links. With privacy and security ensured, LVSR offers a
                        seamless user experience to connect and engage with others.</p>
                </div>
                <div class="col-12 col-md-6 text-center pt-md-0 pt-3">
                    <img src="/assets/images/hand-holding-smartphone-social-media-concept-min.jpg"
                        class="img-fluid how-it-works-image-2 " alt="">
                </div>
            </div>
        </div>
    </section>

    <!---------------------------------------- About Section Ended ------------------------------------->

    <!------------------------------------ How it Works Section Started -------------------------------->

    <section class="my-5 how-it-works py-5" id="works">
        <div class="container">
            <div class="text-center">
                <h3 class="fw-bold">How it works</h3>
                <p>LVSR simplifies managing and sharing online presence. Customize your profile, share easily, and
                    connect <span class="divider"></span> with others seamlessly. Experience privacy and security
                    assurance.</p>
            </div>
            <div class="row my-5">

                <div class="col-12 col-md-6">
                    <h4 class="fw-bold pt-md-5 pt-0">How it Works</h4>
                    <p class="pt-3">LVSR, a user-friendly app and website, simplifies managing and sharing your online
                        presence. To get started, create an account by providing your name and email. Customize your
                        digital business card with social media links and contact information, and organize them into
                        categories for easy navigation. Easily share your profile with others through QR codes or direct
                        links, enabling seamless connections with friends, colleagues, and clients. Rest assured with
                        strict privacy measures and enjoy a smooth, hassle-free experience while showcasing your online
                        identity with LVSR.</p>
                </div>
                <div class="col-12 col-md-6 pt-md-0 pt-3">
                    <img src="/assets/images/how-it-works-min.jpg" class="img-fluid how-it-works-image-2 border "
                        alt="">
                </div>
            </div>
            <div class="row my-md-5 my-3">

                <div class="col-12 col-md-6 order-1 order-md-0 pt-md-0 pt-3">
                    <img src="/assets/images/ww-min.jpg" class="img-fluid how-it-works-image-2 border" alt="">

                </div>
                <div class="col-12 col-md-6 order-0 order-md-1">
                    <h4 class="fw-bold pt-md-5 pt-0">How it Works</h4>
                    <p class="pt-3">LVSR, a user-friendly app and website, simplifies managing and sharing your online
                        presence. To get started, create an account by providing your name and email. Customize your
                        digital business card with social media links and contact information, and organize them into
                        categories for easy navigation. Easily share your profile with others through QR codes or direct
                        links, enabling seamless connections with friends, colleagues, and clients. Rest assured with
                        strict privacy measures and enjoy a smooth, hassle-free experience while showcasing your online
                        identity with LVSR.</p>
                </div>

            </div>
        </div>
    </section>

    <!------------------------------------- How it Works Section Ended --------------------------------->

    <!---------------------------------------- FAQ's Section Started ----------------------------------->

    <section>
        <div class="container" id="faqs">
            <div class="text-center">
                <h3 class="fw-bold">FAQ's</h3>
                <p>LVSR simplifies managing and sharing online presence. Customize your profile, share easily, and
                    connect <span class="divider"></span> with others seamlessly. Experience privacy and security
                    assurance.</p>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8">
                    <h6 class="fw-bold my-3">General FAQs:</h6>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    1. What is Link Vault Social Repository (LVSR)?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    LVSR is a mobile app and website that serves as a centralized platform for managing
                                    and sharing your online presence. It allows you to create a digital business card
                                    with links to your various social media profiles, websites, and contact information.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                2. How does LVSR work?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                LVSR works by enabling you to create a personalized profile that includes links to
                                your social media accounts, websites, blogs, and more. You can then share this
                                profile with others using various methods, such as QR codes, NFC (Near Field
                                Communication) technology, or direct links. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                3. Is LVSR available for both Android and iOS devices?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, LVSR is available for both Android and iOS devices, allowing users on different
                                platforms to access and use its features seamlessly.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                4. Can I use LVSR on a desktop computer?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, LVSR offers a web version that can be accessed through any desktop or laptop
                                computer with an internet connection. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                5. Is LVSR a free app or does it require payment?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                LVSR offers both a free version and a premium version with additional features. The
                                free version provides essential functionalities, while the premium version offers
                                enhanced capabilities for a subscription fee. </div>
                        </div>
                    </div>
                    <h6 class="fw-bold mt-5 mb-4">Account and Registration FAQs:</h6>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                                6. How do I create an account on LVSR?
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                To create an account on LVSR, download the app from the respective app store or
                                visit the website. Click on the "Sign Up" or "Create Account" option and follow the
                                prompts to provide your name, email address, and a password. Once registered, you
                                can start using the app. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseThree">
                                7. Can I use LVSR without creating an account?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, you can explore some features of LVSR without creating an account. However, to
                                fully utilize the app's capabilities, such as saving and organizing your links, you
                                will need to create an account.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseThree">
                                8. What information do I need to provide during registration?
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                During registration, you will need to provide your full name, a valid email address,
                                and choose a secure password. Optionally, you can add a profile picture to
                                personalize your account. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseThree">
                                9. How can I change my account information?
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                You can update your account information by going to the "Settings" section within
                                the app or website. From there, you can edit your name, email address, password, and
                                profile picture. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseThree">
                                10. Can I have multiple accounts on LVSR?
                            </button>
                        </h2>
                        <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, you can have multiple accounts on LVSR, but each account will require a unique
                                email address for registration.</div>
                        </div>
                    </div>
                    <h6 class="fw-bold mt-5 mb-4">Features and Functionality FAQs:s</h6>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseThree">
                                11. What are the main features of LVSR?
                            </button>
                        </h2>
                        <div id="collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                The main features of LVSR include creating a digital business card, adding links to
                                social media profiles, websites, and other online platforms, organizing links into
                                categories, and sharing your profile via QR codes or NFC. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseThree">
                                12. How can I add my social media links to LVSR?
                            </button>
                        </h2>
                        <div id="collapseTwelve" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                To add your social media links, log in to your LVSR account and navigate to the
                                "Edit Profile" section. From there, click on the "Add Link" button, select the
                                social media platform, and enter the URL of your profile. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThree">
                                13. Can I organize my links into different categories?
                            </button>
                        </h2>
                        <div id="collapseThirteen" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, you can organize your links into different categories to keep your profile
                                organized. In the "Edit Profile" section, you can create and manage categories, such as
                                "Social Media," "Portfolio," or "Contact Information."</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseForteen" aria-expanded="false" aria-controls="collapseThree">
                                14. Does LVSR support NFC technology for sharing my profile?
                            </button>
                        </h2>
                        <div id="collapseForteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, LVSR supports NFC technology, allowing you to share your profile simply by tapping
                                your NFC-enabled device on another NFC-capable device.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseThree">
                                15. Can I share my LVSR profile on other platforms?
                            </button>
                        </h2>
                        <div id="collapseFifteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, you can share your LVSR profile on various platforms, such as social media, email,
                                or messaging apps. LVSR provides direct links and QR codes for easy sharing.
                            </div>
                        </div>
                    </div>
                    <h6 class="fw-bold mt-5 mb-4">Features and Functionality FAQs:s</h6>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseThree">
                                16. How does LVSR handle my personal information?
                            </button>
                        </h2>
                        <div id="collapseSixteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                LVSR takes your privacy seriously. We collect and process your personal information only
                                as necessary to provide our services, and we follow strict security measures to
                                safeguard your data.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseThree">
                                17. Is my data secure on LVSR?
                            </button>
                        </h2>
                        <div id="collapseSeventeen" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, your data is secure on LVSR. We implement industry-standard security measures to
                                protect your information from unauthorized access, loss, or misuse. </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseThree">
                                18. Does LVSR share my information with third parties?
                            </button>
                        </h2>
                        <div id="collapseEighteen" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                LVSR does not sell or rent your personal information to third parties. However, we may
                                share your data with trusted service providers who assist us in delivering our services.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseNinteen" aria-expanded="false" aria-controls="collapseThree">
                                19. Can I control who sees my profile and links?
                            </button>
                        </h2>
                        <div id="collapseNinteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, you can control the visibility of your profile and links. In the "Edit Profile"
                                section, you can choose whether your profile is public or private, and you can also
                                manage the visibility of each individual link.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwenty" aria-expanded="false" aria-controls="collapseThree">
                                20. How does LVSR prevent spam and abusive content?
                            </button>
                        </h2>
                        <div id="collapseTwenty" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                LVSR employs advanced algorithms and community reporting mechanisms to detect and
                                prevent spam and abusive content. Users are encouraged to report any inappropriate
                                content for swift action.</div>
                        </div>
                    </div>
                    <h6 class="fw-bold mt-5 mb-4">Paid Services and Billing FAQs:</h6>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentyOne" aria-expanded="false" aria-controls="collapseThree">
                                21. What are the premium features of LVSR?
                            </button>
                        </h2>
                        <div id="collapseTwentyOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                The premium version of LVSR offers additional features, such as unlimited link storage,
                                access to advanced analytics, customizable profile themes, and priority customer
                                support.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentyTwo" aria-expanded="false" aria-controls="collapseThree">
                                22. How much does the premium version cost?
                            </button>
                        </h2>
                        <div id="collapseTwentyTwo" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                The pricing for the premium version of LVSR may vary based on subscription plans. Please
                                check the app or website for current pricing details.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentyThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                23. What payment methods are accepted for upgrading to the premium version?
                            </button>
                        </h2>
                        <div id="collapseTwentyThree" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                LVSR accepts various payment methods, including credit cards, debit cards, and online
                                payment platforms, depending on your region.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentyFour" aria-expanded="false" aria-controls="collapseThree">
                                24. Can I cancel my premium subscription, and how?
                            </button>
                        </h2>
                        <div id="collapseTwentyFour" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, you can cancel your premium subscription at any time. Go to the "Account Settings"
                                or "Billing" section of your LVSR account and follow the instructions to cancel the
                                subscription.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentyFive" aria-expanded="false" aria-controls="collapseThree">
                                25. Is there a refund policy for the premium version?
                            </button>
                        </h2>
                        <div id="collapseTwentyFive" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, there is a refund policy for the premium version. If you are not satisfied with the
                                premium features, you can request a refund within the specified time frame from the date
                                of purchase. Please refer to our Refund Policy for more details.</div>
                        </div>
                    </div>
                    <h6 class="fw-bold mt-5 mb-4">Technical Support FAQs:</h6>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentySix" aria-expanded="false" aria-controls="collapseThree">
                                26. What do I do if I encounter technical issues with LVSR?
                            </button>
                        </h2>
                        <div id="collapseTwentySix" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                If you experience technical issues, please check your internet connection and ensure you
                                have the latest app version installed. If the problem persists, contact our support team
                                at info@lvsr.io, and we will assist you.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentySeven" aria-expanded="false"
                                aria-controls="collapseThree">
                                27. How can I report a bug or provide feedback to LVSR?
                            </button>
                        </h2>
                        <div id="collapseTwentySeven" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                We welcome your feedback and appreciate bug reports. You can contact our support team or
                                use the in-app feedback option to report bugs or provide suggestions for improvement.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentyEight" aria-expanded="false"
                                aria-controls="collapseThree">
                                28. Can I access LVSR offline?
                            </button>
                        </h2>
                        <div id="collapseTwentyEight" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                While some features may require an internet connection, you can access your profile and
                                saved links offline once they are synced to your device.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwentyNine" aria-expanded="false" aria-controls="collapseThree">
                                29. Is there a customer support team available for assistance?
                            </button>
                        </h2>
                        <div id="collapseTwentyNine" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Yes, our customer support team is available to assist you with any questions or concerns
                                you may have. You can reach out to us at info@lvsr.io.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThirty" aria-expanded="false" aria-controls="collapseThree">
                                30. Where can I find the Terms and Conditions and Privacy Policy for LVSR?
                            </button>
                        </h2>
                        <div id="collapseThirty" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                You can find the Terms and Conditions and Privacy Policy by visiting the "Legal" or
                                "Policies" section within the app or website. Additionally, these documents are often
                                linked in the registration process and on the LVSR website footer.</div>
                        </div>
                    </div>
                </div>

    </section>

    <!---------------------------------------- FAQ's Section Ended ------------------------------------->

    <!---------------------------------------- Plan Section Started------------------------------------->

    <section class="plan hero-bg py-5 mt-5">
        <div class="container">
            <div class="plan_heading text-center pb-4">
                <h1>Choose Your Plan</h1>
                <p>
                    When someone does something that they know that they shouldn’t do,
                    did they.
                </p>
            </div>
            <div class="row d-flex justify-content-center gap-md-5 gap-3">
                <div class="col-12 col-md-3 pricing_plan py-5">
                    <div class="center-div">
                        <div class="outside_circle">
                            <div class="inside_circle">
                                <h1>01</h1>
                            </div>
                        </div>
                    </div>
                    <div class="plan_content text-center pt-3">
                        <h5>Economy</h5>
                        <p>For the individuals</p>
                        <hr />
                        <p>Secure Online Transfer</p>
                        <hr />
                        <p>Unlimited Styles for interface</p>
                        <hr />
                        <p>Reliable Customer Service</p>
                        <hr />

                        <h2>£199.00</h2>
                    </div>
                    <div class="hide text-center">
                        <button class="btn btn-primary">BUY NOW</button>
                    </div>
                </div>
                <div class="col-12 col-md-3 pricing_plan py-5">
                    <div class="center-div">
                        <div class="outside_circle">
                            <div class="inside_circle">
                                <h1>02</h1>
                            </div>
                        </div>
                    </div>
                    <div class="plan_content text-center pt-3">
                        <h5>Business</h5>
                        <p>For the individuals</p>
                        <hr />
                        <p>Secure Online Transfer</p>
                        <hr />
                        <p>Unlimited Styles for interface</p>
                        <hr />
                        <p>Reliable Customer Service</p>
                        <hr />

                        <h2>£299.00</h2>
                        <div class="hide text-center">
                            <button class="btn btn-primary">BUY NOW</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 pricing_plan py-5">
                    <div class="center-div">
                        <div class="outside_circle">
                            <div class="inside_circle">
                                <h1>03</h1>
                            </div>
                        </div>
                    </div>
                    <div class="plan_content text-center pt-3">
                        <h5>Premium</h5>
                        <p>For the individuals</p>
                        <hr />
                        <p>Secure Online Transfer</p>
                        <hr />
                        <p>Unlimited Styles for interface</p>
                        <hr />
                        <p>Reliable Customer Service</p>
                        <hr />

                        <h2>£399.00</h2>
                        <div class="hide text-center">
                            <button class="btn btn-primary">BUY NOW</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!------------------------------------------- Plan Section Ended------------------------------------>

    <!-------------------------------------- Get In Touch Section Started ------------------------------>

    <section class="get-in-touch py-5">
        <div class="container">
            <h4 class="fw-bold py-3 ">Get In Touch With Us</h4>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <label for="exampleInputEmail1" class="form-label">Enter Your Message here!</label>
                        <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>

                        <button type="submit" class="btn btn-primary my-3">Submit</button>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <img src="/assets/images/active_support.svg" class="img-fluid text-end" alt="">
                </div>
            </div>
        </div>
    </section>

    <!------------------------------------------ Get In Touch Section Ended----------------------------->
@endsection
