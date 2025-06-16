<h2>Register</h2>
<form action="index.php?controller=auth&action=register" method="POST">
    <input type="text" name="id" placeholder="ID" required><br>
    <input type="text" name="fullname" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="index.php?controller=auth&action=loginForm">Login</a></p>
