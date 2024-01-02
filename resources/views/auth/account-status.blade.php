<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles */
        body {
            background-color: #f3f4f6;
            /* Light gray background */
        }

        .pattern-bg {
            background: repeating-linear-gradient(45deg, #e5e7eb, #e5e7eb 10px, #ffffff 10px, #ffffff 20px);
        }
    </style>
    <title>User Status Page</title>
</head>

<body class="pattern-bg">
    <div class="container mx-auto p-8">
        <section class="bg-white p-8 rounded-lg shadow-md">
            <!-- User Account Status Content Goes Here -->
            <div>
                <h1 class="text-2xl text-center font-bold mb-4 text-emerald-500">
                    {{ session()->get('new_register_successfull') }}</h1>
                <h1 class="text-3xl font-bold mb-4">User Account Status</h1>

                <!-- Conditional rendering based on account status -->
                <!-- Example: If the account is inactive -->
                <p class="text-red-500">Your account is currently inactive. Please contact support for assistance.</p>
            </div>
        </section>
    </div>
</body>

</html>
