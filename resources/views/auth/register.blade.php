<form action="{{ route('register') }}" method="POST">
    @csrf
    <label for="name">名前</label>
    <input type="text" name="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">password</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">confirm password</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">登録</button>
</form>
