<!-- Begin contentWrapper -->
<div id="contentWrapper">
	<!-- Begin 2 column content -->
	<div id="content">
		<p id="forum_breadcrumbs">
			<span class="current">Search Results</span>
		</p>
	
		<section class="post clearfix">
			<!-- Page layout: Default -->
			<h2>
				<cufon class="cufon cufon-canvas" alt="Home" style="width: 51px; height: 24px; ">
					<canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas>
					<cufontext>Search Results</cufontext>
				</cufon>
			</h2>


			<div class="page-chunk default">
				<?php if (count($search_results) == 0) { ?>
					No results found.
				<?php } else { ?>
				<table>
					<?php foreach ($search_results as $row) {?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><div class="bar_image_div"><img id="<?php echo $row[0]; ?>" src="broadcast_images/<?php echo $row[0]; ?>.jpg"/></div></td>
						</tr>
					<?php } ?>
				</table>
				<?php } ?>
				<p>
					Don't see your favorite bar here?  Tell them to sign up for Barview!
				</p>
			</div>

		</section>
	</div>
	<!-- End 2 column content -->
	<aside>
		<div id="navigation">
			<h2>
				<cufon class="cufon cufon-canvas" alt="Navigation" style="width: 94px; height: 24px; ">
					<canvas width="106" height="29" style="width: 106px; height: 29px; top: -3px; left: -2px; "></canvas>
					<cufontext>Navigation</cufontext>
				</cufon>
			</h2>
			<ul>
				
			</ul>
		</div>
	</aside>

			
</div>
<!-- End contentWrapper -->
