<?php 
    require_once("template_scripts.php");

    PageHeader("Chaty");
    ?>

    <main>
        <nav>
            <header>
                <i class="fas fa-search"></i>
            </header>
            <div class="chatlist">
                <?php GenerateMultiplePersons(10); ?>
            </div>
        </nav>
        <section id="rightpanel" class="messagelist">
            <section>
            <?= GenerateMultiple("Message", 20) ?>
            </section>
            <div>
                <span class="textfield"><textarea></textarea></span>
            </div>
        </section>
    </main>
    <script>
        $(document).ready(function() {
            ScrollToBottom("#rightpanel");
        });  
    </script>
    <?php
    PageFooter();
?>

