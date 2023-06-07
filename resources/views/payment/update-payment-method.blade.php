<!DOCTYPE html>
<html>

<head>
    <title>Simple login form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        html,
        body {
            display: flex;
            justify-content: center;
            font-family: Roboto, Arial, sans-serif;
            font-size: 15px;
        }

        form {
            border: 5px solid #f1f1f1;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 16px 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #8ebf42;
            color: white;
            padding: 14px 0;
            margin: 10px 0;
            border: none;
            cursor: grabbing;
            width: 100%;
        }

        h1 {
            text-align: center;
            fone-size: 18;
        }

        button:hover {
            opacity: 0.8;
        }

        .formcontainer {
            text-align: left;
            margin: 24px 50px 12px;
            min-width: 400px;

        }

        .container {
            padding: 16px 0;
            text-align: left;
        }

        span.psw {
            float: right;
            padding-top: 0;
            padding-right: 15px;
        }

        /* Change styles for span on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
    </style>
</head>

<body>
    <div>
        <h1>Login Form</h1>
        <div class="formcontainer">
            <hr />
            <div class="container ">
                <input placeholder="Card Holder Name" value="John Smith" id="card-holder-name" type="text">

                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>

                <input type="hidden" id="user_id" value="{{ $user_id }}">

                <button id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </button>
            </div>
        </div>
</body>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe(
        'pk_test_51NEWX0Ae7CzygjqkMRegP1OpNPF4v5UqfcD7P7IEQXgnjRae7us7QV9xLwTnoIoo6Z2sratUE3bHQhoC2to4MuMk00I6xUBQ2z'
    );

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');


    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        const {
            setupIntent,
            error
        } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        );

        if (error) {
            console.log(error.message);
        } else {

            $.ajax({
                type: "POST",
                url: "{{ route('user-subscribe') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id': $('#user_id').val(),
                    'data': setupIntent
                },
                success: function(res) {
                    console.log(res.data);
                },
            });

            /* $.ajax({
                type: "POST",
                url: "{{ route('payment-details-details') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'data': setupIntent
                },
                success: function(res) {
                    console.log(res.data);
                },
            }); */
        }
    });
</script>

</html>
