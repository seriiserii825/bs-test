<?php 
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Wrap sub-menu items inside a nav or span
        $output .= '<nav class="sub-menu">';
    }
    function end_lvl(&$output, $depth = 0, $args = null) {
        // Close the nav wrapper for sub-menu items
        $output .= '</nav>';
    }
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Check if item has children
        $has_children = !empty($args->walker->has_children);
        // Add class if the item has children
        $class = $has_children ? 'class="has-children"' : '';
        
        // Check if the item is the current menu item
        if (in_array('current-menu-item', $item->classes)) {
            $class = 'class="current-menu-item ' . ($has_children ? 'has-children' : '') . '"';
        }

        $output .= '<a href="' . esc_url($item->url) . '" ' . $class . '>' . esc_html($item->title) . '</a>';
    }
    function end_el(&$output, $item, $depth = 0, $args = null) {
        // No need to add </li> or similar, keeping it minimal
    }
}
