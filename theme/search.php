<?php 
/*
Template Name: Search page
*/
?>
<?php get_header(); ?>
<style type="text/css">
    .page-navigator {
        visibility: hidden;
    }
</style>
<div class="modal">
        <!--Newsletter modal - integration shortcode here-->
        <div class="modal-container">
            <div class="modal-close"><span class="material-icons">close</span></div>
            <div class="modal-title"><span>Sign up</span></div>
            <div class="modal-content">
            <?php echo do_shortcode(
                '[contact-form-7 id="19" title="Contact Moviplus"]'
            );?>
            </div>
        </div>
    </div>
<div class="page-container">
    <nav class="page-navigator">
        <ul id="top-menu">
            <li class="active">
                <a href="#presentation"><span class="text"><?php the_field("presentation"); ?></span></a>
            </li>
            <li>
                <a href="#objectifs"><span class="text"><?php the_field("objectifs_titre"); ?></span></a>
            </li>
            <li>
                <a href="#membres"><span class="text"><?php the_field("titre_membres"); ?></span></a>
            </li>
            <li>
                <a href="#contact"><span class="material-icons">email</span><span class="text"><?php the_field("titre_contact"); ?></span></a>
            </li>
        </ul>
    </nav>
    <section class="pale firstElement" id="presentation">
        <div class="page-content page-presentation">
        <h2 class="page-title"><span>Résultats de recherche</span></h2>
        <?php 
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); ?>
                <h3><?php the_title(); ?></h3>
                <?php $excerpt = wp_trim_words( get_field('objectif_texte' ), $num_words = 50, $more = '...' ); echo $excerpt; ?>
                <a class="page-button" href="<?php the_permalink(); ?>">Aller à la page</a>
            <?php } // end while
        } // end if
        ?>
        </div>
    </section>
</div>
<?php get_footer(); ?>
