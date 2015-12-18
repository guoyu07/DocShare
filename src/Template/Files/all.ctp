<?php
// Turn off all error reporting
error_reporting(0);
?><div class="row">
	
	
	<?php foreach($files as $file): ?>
		<div class="row">
			<div class="articleCotainer">
				<div class="article w3-card-4 w3-yellow">
					<div class="articleTitle"> 
						<?= $this->Html->link($file['title'], ['action' => 'view', $file['id']]) ?>
					</div>
					<?php if(!empty($file['comments']) > 0){ ?>
					<h5>Description</h5>
					<div style="height:300px;">
						<!-- <?= $file['content'] ?> -->
						<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        width="100%"
        height="100%"
        codebase="http://active.macromedia.com/flash5/cabs/swflash.cab#version=8,0,0,0">
        <param name="MOVIE" value="ReportRender.swf">
        <param name="PLAY" value="true">
        <param name="LOOP" value="true">
        <param name="QUALITY" value="high">
        <param name="FLASHVARS" value="zoomtype=3">
          <embed src="http://shareudocs.com/flashfile.swf" width="100%" height="100%"
                 play="true" ALIGN="" loop="true" quality="high"
                 type="application/x-shockwave-flash"
                 flashvars="zoomtype=3"
                 pluginspage="http://get.adobe.com/flashplayer/">
          </embed>
</object>
					</div>
					<?php } ?>

					<?php if(count($file['comments']) > 0){ ?>
					<div clsss="comments">
						<h5>Comments</h5>
						<div class="comment">
							<? foreach($file['comments'] as $comment){ ?>
							<?= "<p>".$comment['authorName']."->".$comment['content']."</p>" ?>
							<? } ?> 
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>   
</div>