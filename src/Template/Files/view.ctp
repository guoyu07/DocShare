
	<div class="container-fluid">     
		
		<?php foreach($articles as $article): ?>
		<div class="row">
			<div class="articleCotainer">
				<div class="article w3-card-4 w3-yellow">
					<div class="articleTitle"> 
						<?= $article['title'] ?>
					</div>
					<h5>Content</h5>
					<div class="articleContent">
						<?= $article['content'] ?>
					</div>
					<div class="authorDate">
					<h6>Date: <?= $article['date'] ?></h6>
					</div>
					<?php if($article['commentsAllowed']){ ?>
						<div class="row" >
						<h1>Add Comment</h1>
							<?php
								echo $this->Form->create('Comment', array('url'=>array('controller'=>'comments', 'action'=>'add')));
								echo $this->Form->input('Name', array('name' => 'authorName'));
								echo $this->Form->hidden('article_id', array('value' => $article['id']));
								echo $this->Form->hidden('date', array('value' => $article['id']));
								echo $this->Form->input('E-Mail', array('name' => 'authorEmail'));
								echo $this->Form->input('content', ['rows' => '5']);
								echo $this->Form->button(__('Send'));
								echo $this->Form->end();
							?>
						</div>
						<?php } ?>
					<div class="comments">
						<h5>Comments</h5>
						<div class="comment">
							<? foreach($article['comments'] as $comment){ ?>
							<?= "<p>".$comment['authorName']."->".$comment['content']."</p>" ?>
							<? } ?> 
						</div>
					</div>
					
				</div>
			</div>
		</div>
	<?php endforeach; ?>   
		
		
		
</div>