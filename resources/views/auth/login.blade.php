<form action="{{ route('login') }}" method="POST">
    @csrf
    <label for="email">email</label>
    <input type="email" name="email" required>

    <label for="password">password</label>
    <input type="password" name="password" required>
    
    <button type="submit">Login</button>
</form>
