<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'versilis-theme');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'versilis-theme'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'versilis-theme');
        }
        return get_the_title();
    }

    public function contact_link() {
        return (object) array(
            'page'              => get_field('contact_page', 'options'),
            'menu_label'   => get_field('contact_page_menu_label', 'options')
        );
    }

    public function header() {
        $header_theme = get_field('header_theme');
        
        return (object) array(
            'theme' => $header_theme,
            'logo'  => ($header_theme=='o-theme-header-dark') ? 'inverse' : ''
        );
    }

    public static function get_menu( $menu_name, $menu_id, $menu_classes='' ) {
        //menu with detached submenus
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_list = '';
            $count = 0;
            $submenu_list= '';
            $submenu = false;
            $cpi=get_the_id();
            foreach( $menu_items as $current ) {
                    if($cpi == $current->object_id ){
                        if ( !$current->menu_item_parent ) {
                            $cpi=$current->ID;
                        }else{
                            $cpi=$current->menu_item_parent;
                        }
                        $cai=$current->ID;
                        break;
                    }else{
                        $cai=0;
                    }
            }

            $menu_list = '<ul id="'.$menu_id.'" class="nav ' . $menu_classes . '">';

            //get highlights
            $menu_highlights = get_field('menu_highlights','options');
            $menu_items_highlight = array();
            if ( !empty($menu_highlights) ) {
                foreach( $menu_highlights as $highlight_item ) {
                    $menu_items_highlight[intval($highlight_item['menu_item'])] = array(
                        'image'     => $highlight_item['image'],
                        'title'     => $highlight_item['title'],
                        'link_url'  => $highlight_item['link']['url']
                    );
                }
            }

            foreach( $menu_items as $key => $menu_item ) {
                    $link = $menu_item->url;
                    $title = $menu_item->title;
                    $menu_item->ID==$cai ? $ac2=' current_menu' : $ac2='';
                    if ( !$menu_item->menu_item_parent ) {
                        if ( !empty($menu_item->description) ) {
                            $parent_menu_item_description = $menu_item->description;
                        }
                        $menu_classes = ( !empty($menu_item->classes) ) ? implode( " ", $menu_item->classes ) : '';
                            $parent_id = $menu_item->ID;$parent_id==$cpi ? $ac=' current-menu-item' : $ac='';
                            if(!empty($menu_items[$count + 1]) && $menu_items[ $count + 1 ]->menu_item_parent == $parent_id ){//Checking has child
                                    $menu_list .= '<li class="menu-item dropdown has_child'.$ac.' '.$menu_classes.'" data-dropdown="sub-menu-'.$menu_item->ID.'"><a href="'.$link.'" class="'.$ac2.'" role="button" data-text="'.$title.'">'.$title.'</a>';
                            }else{
                                    $menu_list .= '<li class="menu-item '.$ac.' '.$menu_classes.'">' ."\n";$menu_list .= '<a href="'.$link.'" class="'.$ac2.'" data-text="'.$title.'">'.$title.'</a>' ."\n";
                            }

                    }

                    if ( array_key_exists($parent_id, $menu_items_highlight) ) {
                        $item_highlight = array();
                        $highlight_content = $menu_items_highlight[$parent_id];
                        $item_highlight = '<div class="menu-item-highlight">' ."\n";
                        $item_highlight .= '<a href="' . $highlight_content['link_url'] . '" title="' . $highlight_content['title'] . '">' ."\n";
                        $item_highlight .= '<img src="' . wp_get_attachment_image_url( $highlight_content['image'], 'layout_img' ) . '" class="u-mb" />' ."\n";
                        $item_highlight .= $highlight_content['title'];
                        $item_highlight .= '</a>' ."\n";
                        $item_highlight .= '<div>'."\n" ;
                    }
                    
                    if ( $parent_id == $menu_item->menu_item_parent ) {
                        $col_class = ( !empty($item_highlight) ) ? 'col-lg-4' : 'col-lg-3' ;
                        if ( !$submenu ) {
                                $submenu = true;
                                $submenu_list .= '<div class="sub-menu__wrapper">';
                                $submenu_list .= '<div class="sub-menu sub-menu-' . $parent_id . '"><div class="row dropdown-menu">' ."\n";
                                if ( !empty($item_highlight) ) {
                                    $submenu_list .= '<div class="col-lg-9"><div class="row">' ."\n";
                                }
                        }
                        if (!empty($parent_menu_item_description)) {
                            $submenu_list .= '<div id="'.$menu_item->ID.'" class="item ' . $col_class . ' sub-menu__intro">' . $parent_menu_item_description . '</div>';
                            $parent_menu_item_description = '';
                        }
                        $submenu_list .= '<div id="'.$menu_item->ID.'" class="item ' . $col_class . '"><ul>' ."\n";
                        $submenu_list .= '<li><a href="'.$link.'" class="sub-menu-item '.$ac2.'">';
                        $submenu_list .= '<div><span>'.$title.'</span></div>' ."\n";
                        $submenu_list .= ( !empty($menu_item->description) ) ? '<p class="sub-menu-item__descr">'.$menu_item->description.'</p>' : '';
                        $submenu_list .= '</a></li></div>' ."\n";
                        if(empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu){
                                $submenu_list .= '</ul></div>' ."\n";
                                if ( !empty($item_highlight) ) {
                                    $submenu_list .= '</div><div class="col-lg-3">' . $item_highlight . '</div>'."\n";
                                }
                                $submenu_list .= '</div></div>' ."\n";
                                $submenu = false;
                        }
                    }

                    if (empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) {
                            $menu_list .= '</li>' ."\n";
                            $submenu = false;
                    }
                    $count++;
            }
        } else {
                $menu_list .= '<li>Menu "' . $menu_name . '" not defined.</li>';
        }
        $menu_list .= self::get_language_link();
        $menu_list .= '</ul>';

        $menu_output = $menu_list . '<div class="sub-menu-container">' . $submenu_list . '<div class="sub-menu-background"></div></div>';

        return $menu_output;

        /*
        
        //menu with detached submenus
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_list = '';
            $count = 0;
            $submenu_list= '';
            $submenu = false;
            $cpi=get_the_id();
            foreach( $menu_items as $current ) {
                    if($cpi == $current->object_id ){
                        if ( !$current->menu_item_parent ) {
                            $cpi=$current->ID;
                        }else{
                            $cpi=$current->menu_item_parent;
                        }
                        $cai=$current->ID;
                        break;
                    }else{
                        $cai=0;
                    }
            }

            $menu_list = '<ul id="'.$menu_id.'" class="nav">';

            foreach( $menu_items as $menu_item ) {
                    $link = $menu_item->url;
                    $title = $menu_item->title;
                    $menu_item->ID==$cai ? $ac2=' current_menu' : $ac2='';
                    if ( !$menu_item->menu_item_parent ) {
                        $menu_classes = ( !empty($menu_item->classes) ) ? implode( " ", $menu_item->classes ) : '';
                            $parent_id = $menu_item->ID;$parent_id==$cpi ? $ac=' current-menu-item' : $ac='';
                            if(!empty($menu_items[$count + 1]) && $menu_items[ $count + 1 ]->menu_item_parent == $parent_id ){//Checking has child
                                    $menu_list .= '<li class="menu-item dropdown has_child'.$ac.' '.$menu_classes.'" data-dropdown="sub-menu-'.$menu_item->ID.'"><a href="'.$link.'" class="'.$ac2.'" role="button">'.$title.'</a>';
                            }else{
                                    $menu_list .= '<li class="menu-item '.$ac.' '.$menu_classes.'">' ."\n";$menu_list .= '<a href="'.$link.'" class="'.$ac2.'">'.$title.'</a>' ."\n";
                            }

                    }
                    if ( $parent_id == $menu_item->menu_item_parent ) {
                            if ( !$submenu ) {
                                    $submenu = true;
                                    $submenu_list .= '<div class="sub-menu sub-menu-' . $parent_id . '"><div class="row dropdown-menu">' ."\n";
                            }
                            $submenu_list .= '<div id="'.$menu_item->ID.'" class="item col-4">' ."\n";
                            $submenu_list .= '<a href="'.$link.'" class="sub-menu-item '.$ac2.'">';
                            $submenu_list .= '<div><span>'.$title.'</span></div>' ."\n";
                            $submenu_list .= ( !empty($menu_item->description) ) ? '<p class="sub-menu-item__descr">'.$menu_item->description.'</p>' : '';
                            $submenu_list .= '</a></div>' ."\n";
                            if(empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu){
                                    $submenu_list .= '</div></div>' ."\n";
                                    $submenu = false;
                            }
                    }
                    if (empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) {
                            $menu_list .= '</li>' ."\n";
                            $submenu = false;
                    }
                    $count++;
            }
        } else {
                $menu_list .= '<li>Menu "' . $menu_name . '" not defined.</li>';
        }
        $menu_list .= '</ul>';

        $menu_output = $menu_list . '<div class="sub-menu-container">' . $submenu_list . '<div class="sub-menu-background"></div></div>';

        return $menu_output;

        */
    }

    public static function get_mega_menu( $menu_name, $menu_id, $menu_classes='' ) {
        //menu with detached submenus
        $output = '';
        $sub_menus = array();

        $mega_menu = get_field('sections', 'options');

        if ( !empty($mega_menu) ) {
            //build nav
            $output = '<ul id="' . $menu_id . '" class="nav">';
            
            //sections
            foreach( $mega_menu as $key => $section ) {
                if ( !empty($section['section_elements']) ) {
                    $link = ($section_type==='text') ? '#' : get_permalink($section['section_link']->ID);
                    $output .= '<li class="menu-item dropdown has_child " data-dropdown="sub-menu-' . $key . '">';
                    $output .= '<a href="' . $link . '" class="" role="button">' . $section['section_title'] . '</a>';
                    $output .= '</li>';

                    $sub_menu_content = array(
                        'intro' => '',
                        'elements' => '',
                        'highlight' => ''
                    );

                    $has_highlight = false;

                    foreach ( $section['section_elements'] as $val ) {
                        if ( $sub_menu_el['acf_fc_layout'] === 'highlight') {
                            $has_highlight = true;
                        }
                    }

                    // sub menu elements
                    foreach( $section['section_elements'] as $sub_menu_el ) {
                        $col = ($has_highlight===true) ? "col-4" : "col-3";

                        switch($sub_menu_el['acf_fc_layout']) {
                            case 'intro' :
                                $sub_menu_content['intro'] .= '<div class="'.$col.' u-mb-sm">';
                                $sub_menu_content['intro'] .= '<p class="sub-menu__intro">' . $sub_menu_el['intro'] . '</p>';
                                $sub_menu_content['intro'] .= '</div>';
                                break;
                            
                            case 'link_description' :
                                $link_title = get_the_title($sub_menu_el['link_element']);
                                $sub_menu_content['elements'] .= '<div class="'.$col.' u-mb-sm">';
                                $sub_menu_content['elements'] .= '<a href="' . get_permalink($sub_menu_el['link_element']) . '" class="sub-menu-item" title="' . $link_title . '"><div><span>' . $link_title . '</span></div>';
                                $sub_menu_content['elements'] .= '<p class="sub-menu-item__descr">' . $sub_menu_el['link_description'] . '</p></a>';
                                $sub_menu_content['elements'] .= '</a>';
                                $sub_menu_content['elements'] .= '</div>';
                                break;

                            case 'highlight' :
                                $sub_menu_content['highlight'] .= '<div class="'.$col.' u-mb-sm">';
                                $sub_menu_content['highlight'] .= '<div class="menu-item-highlight">';
                                $sub_menu_content['highlight'] .= '<a href="' . get_permalink($sub_menu_el['highlight_link']) . '" class="" title="' . $link_title . '"><div><span></span></div>';
                                $sub_menu_content['highlight'] .= '<img src="' . wp_get_attachment_image_url( $sub_menu_el['highlight_image'], 'layout_img' ) . '" class="u-mb" />';
                                $sub_menu_content['highlight'] .= '<div>' . $sub_menu_el['highlight_title'] . '</div>';
                                $sub_menu_content['highlight'] .= '</a>';
                                $sub_menu_content['highlight'] .= '</div>';
                                $sub_menu_content['highlight'] .= '</div>';
                                break;

                            case 'links_list' : 
                                $sub_menu_content['elements'] .= '<div class="'.$col.' u-mb-sm">';
                                $sub_menu_content['elements'] .= '<div class="menu-list-title">' . $sub_menu_el['links_list_title'] . '</div>';
                                $sub_menu_content['elements'] .= '<ul class="link-list">';
                                
                                foreach( $sub_menu_el['links_list_elements'] as $link ) {
                                    $post_id = $link['submenu_links_element'];
                                    $link_title = get_the_title($post_id);
                                    $label = ( get_post_type($post_id)==='product' && get_field('crashworthy', $post_id ) ) ? '<div class="highlight-label">'. __('Crashworthy', 'versilis-theme') . '</div>' : '';
                                    $sub_menu_content['elements'] .= '<li>';
                                    $sub_menu_content['elements'] .= '<a href="' . get_permalink($link['submenu_links_element']) . '" class="sub-menu-item" title="' . $link_title . '"><div><span>' . $link_title . '</span>' . $label . '</div>';
                                    $sub_menu_content['elements'] .= '</li>';
                                }

                                $sub_menu_content['elements'] .= '</ul>';
                                $sub_menu_content['elements'] .= '</div>';
                                break;

                            default : 
                                break;
                        }
                    }

                    //build sub menu
                    $sub_menu .= '<div class="sub-menu" id="sub-menu-' . $key . '">';
                    $sub_menu .= '<div class="o-container">';

                    if (!empty($sub_menu_content['highlight'])) {
                        $sub_menu .= '<div class="row dropdown-menu">';
                        $sub_menu .= '<div class="col-9">';
                    }

                    $sub_menu .= '<div class="row dropdown-menu">';
                    $sub_menu .= ( !empty($sub_menu_content['intro']) ) ? $sub_menu_content['intro'] : '';
                    $sub_menu .= ( !empty($sub_menu_content['elements']) ) ? $sub_menu_content['elements'] : '';
                    $sub_menu .= '</div>';

                    if (!empty($sub_menu_content['highlight'])) {
                        $sub_menu .= '</div>';
                        $sub_menu .= $sub_menu_content['highlight'];
                        $sub_menu .= '</div>';
                    }

                    $sub_menu .= '</div>';
                    $sub_menu .= '</div>';


                }else {
                    $output .= '<li class="menu-item">';
                    $output .= '<a href="' . $link . '" class="" title="' . $section['section_link']->post_title . '">' . $section['section_link']->post_title . '</a>';
                    $output .= '</li>';
                }
                

                //<li class="menu-item dropdown has_child " data-dropdown="sub-menu-283">
            }

            $output .= '</ul>';
            $output .= $sub_menu;
        }

        return $output;
    }

    public static function get_language_link() {
        global $sitepress_settings, $sitepress;
        if ( function_exists('icl_object_id') ) {
            $languages = $sitepress->get_ls_languages();
            if(!empty($languages)){
                foreach($languages as $code => $lang){
                    if ($lang['language_code'] != $sitepress->get_current_language()){
                        $items .= ' <li class="menu-item menu-item-language menu-item-language-current"><a href="' . $lang['url'] . $url_parameters . '">' . $lang['code'] . '</a></li>';
                    }
                }
            }
            return $items;
        }
    }

    public function footer() {
        return array(
            'address'       => get_field('address', 'options'),
            'social_media'  => get_field('social_media', 'options')
        );
    }
}
