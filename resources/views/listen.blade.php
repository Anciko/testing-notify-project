<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Listening</title>
</head>

<body>
    <h1>I am Listening my event that will events to me!</h1>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.channel('notification')
            .listen('SendNotificationEvent', (e) => {
                console.log(e.message);
                console.log("Showing it without reload Lee pl kwar");
            })
        // Echo.channel('notification')
        //     .listen('MessageNotification', (e) => {
        //         console.log("Showing without reload I got it");
        //     })
    </script>
</body>

</html>
