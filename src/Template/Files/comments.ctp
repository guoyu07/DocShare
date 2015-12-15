
	<div class="container-fluid">   
	
		<div class="row">
        <h1> Article Comments </h1>
        <table>
            <tr>
                <th>Content</th>
                <th>Date</th>
                <th>Author name</th>
                <th>Author Email</th>
                <th>Status</th>
            </tr>

            <!-- Here is where we iterate through our $articles query object, printing out article info -->

            <?php foreach ($file["comments"] as $comment): ?>
            <tr>
                <td>
                    <?= $this->Html->link($comment->content, ['action' => 'view', $comment->id]) ?>       
                </td>                
                <td><?= $comment->date ?></td>
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
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>