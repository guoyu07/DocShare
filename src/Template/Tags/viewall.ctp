	
	
	<div class="container-fluid">  
		
		
		<div class="row">
        <h1> Files </h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Comments</th>
                
            </tr>
            <!-- Here is where we iterate through our $articles query object, printing out article info -->
            <?php foreach ($filesArray as $object): 
					$article = $object->file; 
			?>
			<tr>
                <td>
                    <?= $this->Html->link($article->title, ['controller' => 'Files', 'action' => 'view', $article->id]) ?>       
                </td>                
                <td><?= $article->date ?></td>
                <td><?= $this->Html->link($article->commentCount, ['controller' => 'Files', 'action' => 'comments', $article->id]) ?> </td>
               
            </tr>
			<?php endforeach; ?>
        </table>
    </div>
</div>