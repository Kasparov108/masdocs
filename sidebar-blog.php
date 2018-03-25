<div class="site-aside">
    <div class="site-aside-inner">
    <?php 
        the_widget( 'WP_Widget_Categories', 'hierarchical=true' );
        the_widget( 'WP_Widget_Archives' );
        the_widget( 'WP_Widget_Tag_Cloud' );
    ?>
    </div>
</div>