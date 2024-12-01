<?php 
/*
Template Name: Accueil
*/
?>
<?php get_header(); ?>
<article <?php if (current_user_can('manage_options')) { ?><?php live_edit(''); ?><?php } ?>>
    <?php while( have_rows('liste_de_domaines') ) : the_row();
        $image = get_sub_field('image');
        if( !empty( $image ) ): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
    <?php endwhile;?>
</article>
<?php get_footer(); ?>
