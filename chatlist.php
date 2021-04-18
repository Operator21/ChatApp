<?php 
    require_once("template_scripts.php");

    PageHeader("Chaty");
    ?>

    <main>
        <nav>
            <header>
                <a><i class="fas fa-search"></i></a>
            </header>
            <div class="chatlist">
                <?php GenerateMultiple("ChatRoom", 10); ?>
            </div>
        </nav>
        <section id="rightpanel" class="messagelist">
            <section>
            <?= GenerateMultiple("Message", 20) ?>
            </section>
            <div class="inputdiv">
                <span class="textfield"><textarea id="textarea"></textarea></span>
                <a href="#emojimenu" rel="modal:open"><i class="far fa-grin-alt"></i></a>
            </div>
        </section>
    </main>
    <div id="emojimenu" class="modal"></div>
    <script>
        $("#rightpanel").ready(function() {
            ScrollToBottom("#rightpanel");
            EmojiMenu();
        });  
    </script>
    <?php
    PageFooter();
?>

