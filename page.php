<?php $custom_post = new WP_Query( array( 'post_type' => 'custom_post', 'paged' => get_query_var( 'paged' ), 'order' => 'DESC' ) ); ?>

<? if( $custom_post->have_posts() ) : ?>

	<? while( $custom_post->have_posts() ) : $custom_post->the_post(); ?> 

		<!-- while body -->

	<?php endwhile; ?>

	<?php mx_navigation( 'custom_post' ); ?>

<?php else : ?>

	<h2>Ничего нет</h2>
	
<?php endif; ?>