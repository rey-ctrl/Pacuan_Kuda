<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-green-500 to-green-700 flex items-center justify-center min-h-screen p-4">

  <div class="w-full max-w-4xl bg-white shadow-lg rounded-2xl overflow-hidden flex flex-col md:flex-row">

    <div class="w-full md:w-1/2 bg-gradient-to-r from-green-600 to-green-800 text-white flex flex-col justify-center items-center p-8">
      <h2 class="text-3xl font-bold mb-4">HELLO, FRIEND!</h2>
      <p class="text-sm mb-6 text-center">
        Don't have an account yet? Click below to create your account.
      </p>
      <a href="{{ route('register') }}" class="bg-white text-green-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition duration-300 shadow-lg">
        REGISTER
      </a>
    </div>

    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-center text-green-700 mb-4">Login</h2>
      <p class="text-center text-gray-500 text-sm mb-6">Enter your account details</p>

      {{-- Menampilkan Pesan Error Global (jika ada) --}}
      @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded relative text-sm text-center">
            {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50 focus-within:ring-2 focus-within:ring-green-500 transition">
                <span class="material-icons text-gray-400 mr-2">email</span>
                {{-- value="{{ old('email') }}" agar tidak hilang saat salah password --}}
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full outline-none bg-transparent" required autofocus>
            </div>
        </div>

        <div>
            <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50 focus-within:ring-2 focus-within:ring-green-500 transition">
                <span class="material-icons text-gray-400 mr-2">lock</span>
                <input type="password" name="password" placeholder="Password" class="w-full outline-none bg-transparent" required>
            </div>
        </div>

        <div class="flex items-center justify-between text-sm pt-2">
            <label class="flex items-center text-gray-600 cursor-pointer hover:text-green-700 transition select-none">
                {{-- name="remember" ini wajib ada --}}
                <input type="checkbox" name="remember" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500 mr-2 accent-green-700">
                <span>Remember Me</span>
            </label>
            <a href="#" class="text-green-600 hover:underline hover:text-green-800 font-medium">Forgot Password?</a>
        </div>

        <button type="submit" class="w-full bg-green-700 text-white py-3 rounded-full font-semibold hover:bg-green-800 transition duration-300 shadow-md transform hover:-translate-y-1">
          LOGIN
        </button>

      </form>
    </div>
  </div>

</body>
</html>