<?php
/**
 * FrequentlyEditedPages.php
 */

namespace ICaspar\RecentlyEditedPages;


/**
 * Class RecentlyEditedPages
 * @package ICaspar\RecentlyEditedPages
 */
class RecentlyEditedPages {

	public function hookWidgetToDashboard(): void {
		add_action( 'wp_dashboard_setup', [ $this, 'addWidgetToDashboard' ] );
	}

	public function addWidgetToDashboard(): void {
		wp_add_dashboard_widget(
			'ic-recently-edited-pages',
			__( 'Recently Edited Pages', 'ic-rep' ),
			[ $this, 'renderWidget' ]
		);
	}

	public function renderWidget(): void {
		$args = [
			'post_type'      => 'page',
			'orderby'       => 'modified',
			'order'          => 'DESC',
			'posts_per_page' => 5,
		];

		$recentlyEditedPagesList = new \WP_Query( $args );

		if ( $recentlyEditedPagesList->have_posts() ) {
			echo '<ul>';
			while ( $recentlyEditedPagesList->have_posts() ) {
				$recentlyEditedPagesList->the_post();
				?>
                <li>
                    <span style="color:#72777c;display:inline-block;min-width:150px;margin-right:5px"><?php the_modified_date(); ?></span>&nbsp;
					<?php edit_post_link( get_the_title() ); ?>
                </li>
				<?php
			}
			echo '</ul>';
		}

		wp_reset_postdata();
	}
}