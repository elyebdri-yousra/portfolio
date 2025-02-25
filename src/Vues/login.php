<?php if(!empty($_SESSION['error'])): ?>
    <div style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<form action="index.php?action=loginProcess" method="POST">
    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Mot de passe :</label>
    <input type="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>