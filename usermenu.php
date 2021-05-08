<img src="<?= $user["avatar"] ?>" onclick="ChangeAvatar()">
<h1><?= $user["nick"] ?></h1>
<p><?= $user["email"] ?></p>
<br>
<h4>Téma aplikace</h4>
<select onchange="ChangeTheme()" id="themeselector">
    <?php GenerateThemeSelection(); ?>
</select>
<a class="button" href="#" onclick="Logout()">Odhlásit se</a>
