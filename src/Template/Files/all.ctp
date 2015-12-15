<div class="row">
	
	
	<?php foreach($files as $file): ?>
		<div class="row">
			<div class="articleCotainer">
				<div class="article w3-card-4 w3-yellow">
					<div class="articleTitle"> 
						<?= $this->Html->link($file['title'], ['action' => 'view', $file['id']]) ?>
					</div>
					<?php if(!empty($file['comments']) > 0){ ?>
					<h5>Description</h5>
					<div class="articleContent">
						<?= $file['content'] ?>
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