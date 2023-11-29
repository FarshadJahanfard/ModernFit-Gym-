<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Purchased Successfully</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        #container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #3f51b5;
        }
        p {
            margin-bottom: 15px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        strong {
            color: #333;
        }
        #passcode {
            font-size: 24px;
            color: #e91e63;
            font-weight: bold;
        }
        a.link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3f51b5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>{{ config('app.name') }}</h1>

    <p>Thank you for purchasing a Membership! Here are the details:</p>

    <ul>
        <li><strong>Start Date:</strong> {{ $membership->pivot->start_date }}</li>
        <li><strong>End Date:</strong> {{ $membership->pivot->end_date }}</li>
        <li><strong>Passcode:</strong> <span id="passcode">{{ $membership->pivot->passcode }}</span></li>
    </ul>

    <a class="link" href="{{ url('/memberships') }}">View Membership Details</a>

    <p>If you have any questions or concerns, feel free to contact us.</p>

    <p>Enjoy your membership!</p>

    <p>Thanks,<br>{{ config('app.name') }}<br>© 2023 {{ config('app.name') }}. All rights reserved.</p>
</div>
</body>
</html>
