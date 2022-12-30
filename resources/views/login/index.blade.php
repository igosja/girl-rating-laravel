<?php
declare(strict_types=1);

?>
<html lang="uk">
<head><title>login</title></head>
<body>
<form method="POST" action="/login">
    @csrf

    @error('email', 'password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input name="email"/>
    <input name="password"/>
    <button>Submit</button>
</form>
</body>
</html>
