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
<main class="welcome">
    <div class="splitter">
        <div>
            <h1 class="width-250">Buďte spolu, ale dostatečně daleko</h1>
            <h4 class="width-250">Díky ChatApp nemusíme přemýšlet nad tím jestli vám někdo krade osobní údaje, u nás máte jistotu, že ano.</h4>
            <div class="signindiv">
                <?php 
                    include_once("form_login.php");
                    include_once("form_register.php");
                ?>
            </div>
        </div>
        <div>
            <img src="img/devices.png">
        </div>
    </div>
    <footer>
        <h4>Stanislav Zdych &copy; 2021</h4>
    </footer>
</main>
