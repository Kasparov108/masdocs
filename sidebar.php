<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package masDocs
 */
?>

<aside id="secondary" class="sidebar-area">
<?php
    //get_search_form();

    $walker = new WeDevs\WeDocs\Walker();
    $children = wp_list_pages( array(
        'title_li'  => '',
        'order'     => 'menu_order',
        'echo'      => false,
        'post_type' => 'docs',
        'walker'    => $walker
    ) );
    ?>

    <?php if ($children) { ?>
        <ul class="doc-nav-list">
            <?php
                $front_page_id = get_option( 'page_on_front' );
                wp_list_pages( array( 'title_li' => false, 'include' => $front_page_id ) ); ?>
            <?php echo $children; ?>
        </ul>
    <?php } ?>
</aside>
