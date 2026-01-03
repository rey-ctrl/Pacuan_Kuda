<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-green-500 to-green-700 flex items-center justify-center min-h-screen p-4">

  <div class="w-full max-w-4xl bg-white shadow-lg rounded-2xl overflow-hidden flex">
    
    <div class="w-1/2 bg-gradient-to-r from-green-600 to-green-800 text-white flex flex-col justify-center items-center p-8">
      <h2 class="text-3xl font-bold mb-4">WELCOME BACK!</h2>
      <p class="text-sm mb-6 text-center">
        Already have an account? Click below to log in.
      </p>
      <a href="{{ route('login') }}" class="bg-white text-green-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition duration-300 shadow-lg">
        LOGIN
      </a>
    </div>

    <div class="w-1/2 p-8 flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-center text-green-700 mb-4">Create Account</h2>
      <p class="text-center text-gray-500 text-sm mb-6">Enter your personal details to register</p>

      <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
          <span class="material-icons text-gray-400 mr-2">email</span>
          <!-- Tambahkan penanganan error Blade untuk input email -->
          <input type="email" name="email" placeholder="Email" class="w-full outline-none bg-transparent" value="{{ old('email') }}" required>
        </div>
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        
        <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
          <span class="material-icons text-gray-400 mr-2">lock</span>
          <!-- Tambahkan minlength sesuai validasi Controller -->
          <input type="password" name="password" placeholder="Password (Min. 8 Karakter)" minlength="8" class="w-full outline-none bg-transparent" required>
        </div>
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        
        <button type="submit" class="w-full bg-green-700 text-white py-3 rounded-full font-semibold hover:bg-green-800 transition duration-300 shadow-md">
          REGISTER
        </button>
      </form>

      @if ($errors->any())
        <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
            Terdapat kesalahan pada formulir. Mohon periksa kembali input Anda.
        </div>
      @endif

    </div>
  </div>

</body>
</html>