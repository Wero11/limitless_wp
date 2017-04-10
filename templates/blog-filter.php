<?php global $super_options; ?>

<?php if($super_options[SN.'_blog_fitler_style'] !="open") : ?>

<div class="ioa-menu blog-ioa-menu"  itemscope itemtype='http://schema.org/ItemList'>
	<span><?php _e('Sort','ioa') ?></span>
					<a href="" class="menu-button icon icon-reorder"></a>
					<ul>
						<li data-cat="all" class='active all'><?php _e('All','ioa') ?></li>	
						<?php 
				 		$categories=  get_categories(); 
				 		foreach ($categories as $category) {
				  			$option = '<li data-cat="'.$category->category_nicename.'" class="'.$category->category_nicename.'"><span itemprop="name">';
							$option .= $category->cat_name;
							$option .= '</span>';
							$option .= '<div class="hoverdir-wrap"><span class="hoverdir"></span></div></li>';
							echo $option;
				  		}
						?>
					</ul>
				</div>

<?php else: ?>

<div class="ioa-menu blog-ioa-menu ioa-menu-open"  itemscope itemtype='http://schema.org/ItemList'>
					<ul class="clearfix">
						<li data-cat="all" class='active all'><?php _e('All','ioa') ?></li>	
						<?php 
				 		$categories=  get_categories(); 
				 		foreach ($categories as $category) {
				  			$option = '<li data-cat="'.$category->category_nicename.'" class="'.$category->category_nicename.'"><span itemprop="name">';
							$option .= $category->cat_name;
							$option .= '</span>';
							$option .= '<div class="hoverdir-wrap"><span class="hoverdir"></span></div></li>';
							echo $option;
				  		}
						?>
					</ul>
				</div>

<?php endif; ?>				