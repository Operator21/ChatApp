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
<a href="#registerModal" class="button" rel="modal:open">Zaregistrovat se</a>
<form method="post" id="registerModal" class="modal" action="javascript:Register()">
    <h4>Registrace</h4>
    <input type="email" id="registerEmail" placeholder="Email">
    <input type="text" id="registerNick" placeholder="Přezdívka">
    <input type="password" id="registerPassword" placeholder="Heslo">
    <input type="password" id="registerPasswordCheck" placeholder="Heslo znovu">
    <input type="text" id="bait" placeholder="Toto pole nevyplňovat">
    <input type="submit" value="Zaregistrovat">
</form>