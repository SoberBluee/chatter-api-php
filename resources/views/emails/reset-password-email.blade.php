<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- body -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        <link rel="stylesheet" href="../emails/reset-password-email.blade.php">
    </head>
    <!-- body -->
    <body>
        <h2>Chatter - Reset Password</h2>
        <div class="text-body">
            <p>This is a password reset email</p>
            <p>Please follow this email to reset your password</p>
            <p>{{ $url }}</p>
        </div>
    </body>
</html>
