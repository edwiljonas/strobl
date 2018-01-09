<?php
#MENU WALKER
class gsdh_walker extends Walker{

	var $gsdh_global_opts;
	var $gsdh_global_enable;

	#CONSTRUCT
	function __construct(){
	}

	#HAS CHILDREN
	public $has_children;

	#WHAT THE CLASS HANDLES
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	#DATABASE FILEDS TO USE
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	#STARTS THE LIST BEFORE THE ELEMENTS ARE ADDED
	public function start_lvl( &$output, $depth = 0, $args = array() , $id = 0) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	#ENDS THE LIST AFTER THE ELEMENTS ARE ADDED
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	#START ELEMENT OUTPUT
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'nav-item';

		#FILTERS THE ARGUMENTS FOR A SINGLE NAV MENU ITEM
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		#FILTERS THE CSS CLASS(ES) APPLIED TO A MENU ITEM'S LIST ITEM ELEMENT
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		#FILTERS THE ID APPLIED
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li ' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		#FILTERS THE HTML ATTR APPLIED TO A MENU ITEM'S ANCHOR ELEMENT
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		#THIS FILTER IS DOCUMENTED IN (wp-includes/post-template.php)
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		#FILTERS THE MENU ITEMS TITLE
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a class="nav-link" '. $attributes .'><span>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</span></a>';

		$item_output .= $args->after;

		#FILTERS THE MENU ITEMS STARTING OUTPUT
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

		//display this element
		$this->has_children = ! empty( $children_elements[ $id ] );
		if ( isset( $args[0] ) && is_array( $args[0] ) ) {
			$args[0]['has_children'] = $this->has_children; // Back-compat.
		}

		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'start_el'), $cb_args);

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach ( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array($this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);

	}

	#CLEAR THE CHILDREN
	function clear_children( &$children_elements , $id ){

		if( empty( $children_elements[ $id ] ) ) return;

		foreach( $children_elements[ $id ] as $child ){
			$this->clear_children( $children_elements , $child->ID );
		}
		unset( $children_elements[ $id ] );
	}

	#END THE ELEMENT OUTPUT IF NEEDED
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	#GET MEGA
	public function gsdh_get_html($type, $show){

		#VARIABLES
		$html = '';

		$html .= $show;

		return $html;

	}

}