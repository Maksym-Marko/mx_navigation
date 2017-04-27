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

		<!-- pagination -->
		<nav class="mx-pagination">
			<ul class="pagination">

				<?php if( $this_page > 1 ): 
					$prev_page = $this_page - 1;
				?>

					<li><a href="<?php echo $url . 'page/' . $prev_page . '/'; ?>" aria-label="Previous"><span aria-hidden="true" id="mx-Previous">«</span></a></li>				
				<?php endif; ?>

				<?php for ( $i = 1; $i <= $count_page; $i++ ) { 
				if( $i === $this_page ){ ?>
					<li class="active">
						<a href="#" onclick="return false;"><?php echo $i; ?></a>
					</li>
				<?php }
				else{ ?>					
					<li>
						<a href="<?php echo $url . 'page/' . $i . '/'; ?>"><?php echo $i; ?></a>
					</li>

				<?php }
				} ?>

				<?php if( $this_page < $count_page ): 
					$next_page = $this_page + 1;
				?>

					<li><a href="<?php echo $url . 'page/' . $next_page . '/'; ?>" aria-label="Next"><span aria-hidden="true" id="mx-Next">»</span></a></li>
				<?php endif;?>
			</ul>
		</nav>
		<!-- pagination -->

	<?php }	
}