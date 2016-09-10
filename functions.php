<?php
// custom_post
add_action( 'init', 'custom_post' );
function custom_post(){
	register_post_type( 'custom_post', array(
		'public' => true,	
		'supports' => array( 'title', 'thumbnail', 'excerpt', 'editor', 'comments' ),
		'labels' => array(
			'name' => 'Новости',
			'all_items' => 'Все новости',
			'add_new' => 'Добавить новость',
			'add_new_item' => 'Добавление новости'
		)		
	) );	
}

//navigation
function mx_navigation( $custom_post ){

	//get count posts оn the page
	$count_posts_in_page = get_option( 'posts_per_page' );

	//get this page
	$this_page = get_query_var( 'paged' );
	$this_page = (int) $this_page;
	if( $this_page === 0 ) $this_page = 1;

	//get count publish posts
	$count_posts = wp_count_posts( $type = $custom_post, $perm = '' )->publish;

	//set count page
	$count_page = $count_posts / $count_posts_in_page;
	$count_page = ceil( $count_page );

	//get url
	$host = $_SERVER['HTTP_HOST'];
	$path = $_SERVER['REQUEST_URI'];
	$url = 'http://' . $host . $path;
	$url = strstr($url, 'page', true);

	//loop links
	if( $count_posts > $count_posts_in_page ){ ?>
		<div class="mx-page_nav">
			<?php for ( $i = 1; $i <= $count_page; $i++ ) { 
			if( $i === $this_page ){ ?>
				<span class="mx-active_page"><?php echo $i; ?></span>
			<?php }
			else{ ?>
				<a href="<?php echo $url . 'page/' . $i . '/'; ?>"  class="mx-link_page"><?php echo $i; ?></a>
			<?php }
			} ?>
		</div>
	<?php }
	
}