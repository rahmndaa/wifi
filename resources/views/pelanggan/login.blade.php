<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WiPaykuu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="flex flex-col items-center justify-center h-screen bg-gray-100 relative">
    <img src="{{ asset('kaiadmin/assets/img/logo-wipaykuu-2.png') }}" width="200" alt="WiPaykuu Logo" />
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4 text-center text-gray-600">Login Pelanggan</h3>
        <form action="{{ route('pelanggan.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <h5 class="text-sm text-gray-600">Username</h5>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <h5 class="text-sm text-gray-600">Password</h5>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Log in</button>
        </form>
    </div>

    <!-- Tombol admin login di pojok kanan bawah -->
    <a href="{{ route('admin.login') }}" class="fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition">
        <i class="fas fa-user-shield text-xl"></i>
    </a>
</body>
</html>
``
