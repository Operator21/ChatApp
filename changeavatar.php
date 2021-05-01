<img id="preview" src="<?= $user["avatar"] ?>">
<input id="imageurl" value="<?= $user["avatar"] ?>" type="text" placeholder="Url adresa obrázku" onkeyup="RefreshPreview()">
<span class="button" onclick="SaveAvatar()">Aktualizovat</span>