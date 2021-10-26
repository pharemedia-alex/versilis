<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/*
 * Customize admin logo
 */
add_action( 'login_enqueue_scripts', function() {

?>
    <style type="text/css">
        body.login {
            background-color: #FFF;
        }
        #login h1 a, .login h1 a {
            background-image: url(<?php echo \App\asset_path('images/admin/Versilis_logo.png'); ?>);
            height:100px;
            width:100%;
            background-size: contain;
            background-repeat: no-repeat;
        }
        .login form#loginform {
            background-color: #FFF;
            border-radius: 10px;
        }
        .login form label{
            color: #143423;
        }
        .login form input[type="text"],
        .login form input[type="password"] {
            border-color: #143423;
        }
        .login form {
            border-radius: 8px;
        }
        .login a {
            color: #FFF !important;
        }
        .login #wp-submit {
            background: #143423;
            border-color: #143423 #143423 #143423;
            box-shadow: 0 1px 0 #143423;
            color: #fff;
            text-decoration: none;
            text-shadow: 0 -1px 1px #143423, 1px 0 1px #143423, 0 1px 1px #143423, -1px 0 1px #143423;
        }
        .login #backtoblog,
        .login #nav {
            display: none !important;
        }
        /*.login #shibboleth-wrap {
            display: none !important;
        }*/
        #login .privacy-policy-page-link {
            display: none;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            _elLoginError = document.querySelector('.login #login_error');
            if(typeof(_elLoginError) != 'undefined' && _elLoginError != null){
                _elLoginError.textContent = 'Veuillez vérifier vos informations de connexion';
            }
        });
    </script>
<?php
} );

add_action( 'admin_enqueue_scripts', function() {
?>
    <style type="text/css">
        .acf-bl.acf-swatch-list li {
            display: inline-block;
            margin-right: 20px;
        }
        .acf-field.disabled input{
            pointer-events:none;
            background-color: #EEE;
        }
    </style>
<?php
} );