<?php if ( $docs ) : ?>

<div class="wedocs-shortcode-wrap">
    <ul class="wedocs-docs-list">
        <?php foreach ($docs as $main_doc) : ?>
            <li class="wedocs-docs-single">
                <h3>
                    <a href="<?php echo get_permalink( $main_doc['doc']->ID ); ?>">
                        <?php echo $main_doc['doc']->post_title; ?>
                    </a>
                    <?php $total_topics = count( $main_doc['sections'] ); if ( $total_topics > 0 ) : ?>
                    <span class="pull-right badge badge-secondary"><?php echo sprintf( _n( '%s topic', '%s topics', $total_topics,  'masdocs' ), $total_topics ); ?></span>
                    <?php endif; ?>
                </h3>

                <?php if ( $main_doc['sections'] ) : ?>

                    <div class="inside">
                        <ul class="wedocs-doc-sections">
                            <?php foreach ($main_doc['sections'] as $section) : ?>
                                <li><a href="<?php echo get_permalink( $section->ID ); ?>"><?php echo $section->post_title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                <?php endif; ?>
                
                <?php if ( $total_topics > 4 ) : ?>

                <div class="wedocs-doc-link">
                    <a data-text="<?php echo esc_attr( __( 'Show all topics', 'masdocs' ) ); ?>" data-toggled-text="<?php echo esc_attr( __( 'Show less topics', 'masdocs' ) ); ?>" href="<?php echo get_permalink( $main_doc['doc']->ID ); ?>"><?php echo esc_html__( 'Show all topics', 'masdocs' ); ?></a>
                </div>

                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif;