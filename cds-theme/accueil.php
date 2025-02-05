<?php 
/*
Template Name: Accueil
*/
?>
<?php get_header(); ?>

<section class="cds-home">
    <h2>My h2 title</h2>
    <p>That's my p tag</p>

    <?php /* Home page
    <article <?php if (current_user_can('manage_options')) { ?><?php live_edit(''); ?><?php } ?>>
        <?php while( have_rows('liste_de_domaines') ) : the_row();
            $image = get_sub_field('image');
            if( !empty( $image ) ): ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        <?php endwhile;?>
    </article>
    */ ?>
</section>

<?php get_footer(); ?>
