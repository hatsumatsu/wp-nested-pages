<?php namespace NestedPages;
/**
* Plugin Dependencies
*/
class Dependencies {

	public function __construct()
	{
		add_action( 'admin_enqueue_scripts', [ $this, 'styles' ]);
		add_action( 'admin_enqueue_scripts', [ $this, 'scripts' ]);
	}

	/**
	* Admin Styles
	*/
	public function styles()
	{
		wp_enqueue_style(
			'nestedpages', 
			plugins_url() . '/nestedpages/assets/css/nestedpages.css', 
			array(), 
			'1.0'
		);
	}

	/**
	* Admin Scripts
	*/
	public function scripts()
	{
		$screen = get_current_screen();
		if ( strpos( $screen->id, 'nestedpages' ) ) :
			wp_enqueue_script('jquery-ui-core');
			
			wp_enqueue_script('jquery-ui-sortable');
			
			wp_enqueue_script(
				'nested-sortable', 
				plugins_url() . '/nestedpages/assets/js/source/jquery.mjs.nestedSortable.js', 
				array('jquery', 'jquery-ui-sortable'), 
				'1.0'
			);
			
			wp_enqueue_script(
				'nestedpages', 
				plugins_url() . '/nestedpages/assets/js/source/nestedpages.js', 
				array('jquery'), 
				'1.0'
			);

			wp_localize_script( 
				'nestedpages', 
				'nestedpages', 
				array( 
					'np_nonce' => wp_create_nonce( 'nestedpages-nonce' ),
				)
			);
		endif;
	}

}