<div class="nav-holder" data-home="<?php echo esc_url(home_url()); ?>">
    <div class="container">
        <div class="row">
            <nav class="navbar sticky-top navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/images/frontend/logo.png" width="215"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-md-end" id="navbarNav">
                    <?php
                    #WALKER CLASS
                    $gsdh_menu_args = array(
                        'theme_location' => 'primary_navigation',
                        'menu_class' => 'navbar-nav',
                        'menu_id' => 'primary',
                    );
                    if ( has_nav_menu( 'primary_navigation' ) ) {
                        $gsdh_menu_args['walker'] = new gsdh_walker();
                    } else {
                        $gsdh_menu_args['link_before'] = '<span>';
                        $gsdh_menu_args['link_after'] = '</span>';
                    }
                    wp_nav_menu( $gsdh_menu_args );
                    ?>
                </div>
            </nav>
        </div>
    </div>
</div>