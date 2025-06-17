<h2>Login</h2>
<form action="index.php?controller=auth&action=login" method="POST">
    <input type="text" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="index.php?controller=auth&action=registerForm">Register</a></p>