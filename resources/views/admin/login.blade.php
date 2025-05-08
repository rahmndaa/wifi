
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WiPaykuu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center h-screen bg-gray-100">
    <img src="{{ asset('img/logo-wipaykuu-2.png') }}" width="200"/>
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4 text-center text-gray-600">Login Admin</h3>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <h5 class="text-sm text-gray-600">Username</h5>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <h5 class="text-sm text-gray-600">Password</h5>
                <input type="password" name="password"class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Log in</button>
        </form>
    </div>
</body>
</html>