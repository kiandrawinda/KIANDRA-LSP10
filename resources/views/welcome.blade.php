<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selamat Datang</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  @auth
    <script>
      window.location.href = "{{ route('dashboard') }}";
    </script>
  @endauth

  <style>
    body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg,#e0e7ff,#f0f4f8); min-height: 100vh; }
    .glass { backdrop-filter: blur(16px); background: rgba(255,255,255,0.7); border-radius: 20px;
      border: 1px solid rgba(200,200,200,0.3); box-shadow: 0 8px 30px rgba(0,0,0,0.12); }
    .btn { transition: .3s; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
  </style>
</head>

<body class="flex items-center justify-center p-4">

<div class="glass p-8 w-full max-w-md">

  <h1 class="text-3xl font-bold text-gray-800 text-center mb-8">Selamat Datang</h1>

  <!-- ERROR ALERT -->
  @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">
      <ul class="list-disc ml-4">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Tabs -->
  <div class="flex justify-around mb-6">
    <button onclick="showForm('login')" class="btn px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg" id="loginBtn">Login</button>
    <button onclick="showForm('register')" class="btn px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg" id="registerBtn">Register</button>
  </div>

  <!-- Login Form -->
  <form action="{{ route('login') }}" method="POST" id="loginForm">
    @csrf
    <input type="email" name="email" placeholder="Email" class="w-full mb-4 p-3 rounded-lg border" required>
    <input type="password" name="password" placeholder="Password" class="w-full mb-4 p-3 rounded-lg border" required>
    <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg btn">Login</button>
    <p class="text-center text-gray-500 text-sm mt-4">
      Belum punya akun?
      <button type="button" onclick="showForm('register')" class="text-blue-500 hover:underline">Register</button>
    </p>
  </form>

  <!-- Register Form -->
  <form action="{{ route('register') }}" method="POST" id="registerForm" class="hidden">
    @csrf
    <input type="text" name="name" placeholder="Nama" class="w-full mb-4 p-3 rounded-lg border" required>
    <input type="email" name="email" placeholder="Email" class="w-full mb-4 p-3 rounded-lg border" required>
    <input type="password" name="password" placeholder="Password" class="w-full mb-4 p-3 rounded-lg border" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full mb-4 p-3 rounded-lg border" required>
    <button type="submit" class="w-full py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg btn">Daftar</button>
    <p class="text-center text-gray-500 text-sm mt-4">
      Sudah punya akun?
      <button type="button" onclick="showForm('login')" class="text-blue-500 hover:underline">Login</button>
    </p>
  </form>

</div>

<script>
function showForm(form) {
  if(form === 'login') {
    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');
  } else {
    registerForm.classList.remove('hidden');
    loginForm.classList.add('hidden');
  }
}
</script>

</body>
</html>
