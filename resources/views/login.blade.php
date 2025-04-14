<h2>Halaman Login Custom</h2>

<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <input type="text" name="username" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Login</button>
</form>

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif