<h1>ようこそ、{{ auth()->user()->name }}さん！</h1>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
