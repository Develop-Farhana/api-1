<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Site</title>
</head>
<body>
    <h2>Welcome, {{ $user->name }}!</h2>
    
    <p>Thank you for registering on our site. Here are your details:</p>
    
    <ul>
        <li><strong>Name:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <!-- Add more user details as needed -->
    </ul>
    
    <p>We look forward to seeing you around!</p>
</body>
</html>
