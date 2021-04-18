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
        <section class="messagelist">
            <header>

            </header>
            <?= GenerateMultiple("Message", 20) ?>
        </section>
    </main>
    
    <?php
    PageFooter();
?>

