<?php
declare(strict_types=1);

?>
<html lang="uk">
<head><title>Singup</title></head>
<body>
<form method="POST" action="/signup">
    @csrf

    @error('name', 'email', 'password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="name">Name</label>
    <input id="name" name="name"/>
    <label for="email">Email</label>
    <input id="email" name="email"/>
    <label for="password">Password</label>
    <input id="password" name="password"/>
    <button>Submit</button>
</form>
</body>
</html>
