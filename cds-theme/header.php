<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php wp_title(''); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@300;400;700&family=Inria+Serif:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/style.css' ?>">
    <?php wp_head(); ?>
</head>
<body>

<header class="cds-header">
    My header
    <button class="cds-header__button">
        <!-- Toggle menu - add an icon -->
    </button>
</header>
    
<?php 
/* $current_language = pll_current_language();
if($current_language == "fr") {
    echo 'Continuer';
} else {
    echo 'Continue';
} */ ?>
        
<ul><?php /* pll_the_languages(); */ ?></ul>

<nav class="cds-nav">
    <div class="cds-nav__inner">
        <?php
            $menu = wp_nav_menu(array(
                'theme_location' => 'main-fr',
                'echo'           => false,
                'menu_class'     => 'cds-nav__inner',
            ));
                    
            echo $menu;
        ?>
        <button class="cds-nav__button">
            <!-- Toggle menu - add an icon -->
        </button>
    </div>
</nav>
