<?php
/**
* Copyright (C) 2021 Stanislav Zdych
* 
* This file is part of the ChatApp.
* 
* ChatApp is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <https://www.gnu.org/licenses/>.
**/
?>
<a href="#loginModal" class="button" rel="modal:open">Přihlásit se</a>
<form method="post" id="loginModal" class="modal" action="javascript:Login()">
    <h4>Přihlášení</h4>
    <input type="email" id="loginEmail" placeholder="Email">
    <input type="password" id="loginPassword" placeholder="Heslo">
    <input type="submit" value="Přihlásit">
</form>