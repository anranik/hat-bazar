<?php
/**
 * Theme hooks
 *
 * @package hat-bazar
 */

/**
 * Top of single post
 */
function hat_bazar_top_single_post_trigger() {
	do_action( 'hat_bazar_top_single_post' );
}

/**
 * Bottom of single post
 */
function hat_bazar_bottom_single_post_trigger() {
	do_action( 'hat_bazar_bottom_single_post' );
}

/**
 * Top of single post content
 */
function hat_bazar_content_single_top_trigger() {
	do_action( 'hat_bazar_content_single_top' );
}

/**
 * Bottom of footer
 *
 * HTML context: at the end of the container class
 */
function hat_bazar_bottom_footer_trigger() {
	do_action( 'hat_bazar_bottom_footer' );
}

/**
 * After footer
 *
 * HTML context: right after the container class
 */
function hat_bazar_after_footer_trigger() {
	do_action( 'hat_bazar_after_footer' );
}

/**
 * Post date box - on content-search
 */
function hat_bazar_post_date_search_box_trigger() {
	do_action( 'hat_bazar_post_date_box', 'post-date' );
}

/**
 * Post date box - on index
 */
function hat_bazar_post_date_index_box_trigger() {
	do_action( 'hat_bazar_post_date_box', 'post-date entry-published updated' );
}

/**
 * Post content on blog listing - top of entry meta
 */
function hat_bazar_content_entry_meta_top_trigger() {
	do_action( 'hat_bazar_content_entry_meta_top' );
}

/**
 * About us after content
 * HTML context: within `.brief-content-one`
 */
function hat_bazar_home_about_section_content_one_after_trigger() {
	do_action( 'hat_bazar_home_about_section_content_one_after' );
}
