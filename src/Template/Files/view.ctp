
	<div class="container-fluid">     
		
		<?php foreach($files as $file): ?>
		<div class="row">
			<div class="fileCotainer">
				<div class="file w3-card-4 w3-yellow">
					<div class="fileTitle"> 
						<?= $file['title'] ?>
					</div>
					<h5>Content</h5>
					<div style="height:700px;">
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
					<div class="authorDate">
					<h6>Date: <?= $file['date'] ?></h6>
					</div>
					<?php if($file['commentsAllowed']){ ?>
						<div class="row" >
						<h1>Add Comment</h1>
							<?php
								echo $this->Form->create('Comment', array('url'=>array('controller'=>'comments', 'action'=>'add')));
								echo $this->Form->input('Name', array('name' => 'authorName'));
								echo $this->Form->hidden('file_id', array('value' => $file['id']));
								echo $this->Form->hidden('date', array('value' => $file['id']));
								echo $this->Form->input('E-Mail', array('name' => 'authorEmail'));
								echo $this->Form->input('content', ['rows' => '5']);
								echo $this->Form->button(__('Send'));
								echo $this->Form->end();
							?>
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