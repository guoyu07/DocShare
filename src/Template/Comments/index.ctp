
	<div class="container-fluid">        
		<div class="row">
        <h1> All Comments </h1>
        <table>
            <tr>
                <th>Content</th>
                <th>Date</th>
				<th>Article Id</th>
                <th>Author name</th>
                <th>Author Email</th>
                <th>Status</th>
				<th>Delete</th>
            </tr>

            <!-- Here is where we iterate through our $articles query object, printing out article info -->

            <?php foreach ($comments as $comment): ?>
            <tr>
                <td>
                    <?= $comment->content ?>       
                </td>                
                <td><?= $comment->date ?></td>
                <td><?= $this->Html->link($comment->article_id, ['controller' => 'Articles', 'action'=>'view', $comment->article_id]) ?></td>
                <td><?= $comment->authorName ?></td>
                <td><?= $comment->authorEmail ?></td>
				<td>
                <?php 
//                       var_dump($comment->approved);
                        if($comment->approved){
                            echo $this->Form->postLink('Disapprove',array(
								'controller'=>'Comments', 
								'action' => 'disapproveComment',
								$comment->id),
                                ['confirm' => 'Are you sure?']);
						}else {
							echo $this->Form->postLink('Approve',array(
								'controller'=>'Comments', 
								'action' => 'approveComment',
								$comment->id),
								['confirm' => 'Are you sure?']);
						}
    
                    ?>
				</td>
				<td>
                    <?= $this->Html->link('Delete', ['action' => 'deleteComment', $comment->id], ['confirm' => 'Are you sure?']) ?>       
                </td>  
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>