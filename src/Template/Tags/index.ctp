
	<div class="container-fluid">        
		
		<div class="row">
        <h1> All Tags </h1>
        <table>
            <tr>
                <th>Value</th>
                <th>slug</th>
				<th>Articles</th>
				<th>Delete</th>
            </tr>

            <!-- Here is where we iterate through our $articles query object, printing out article info -->

            <?php foreach ($tags as $tag): ?>
            <tr>
                <td> <?= $this->Html->link($tag->value,  ['action' => 'view', $tag->id]) ?>  
</td>                
                <td><?= $tag->slug ?> </td>    
				<td> <?= $this->Html->link('View',  ['action' => 'view', $tag->id]) ?>  
</td>
<!--
                <td> //$this->Html->link($comment->article_id, ['controller' => 'Articles', 'action'=>'view', $comment->article_id]) </td>-->

				<td>
                    <?= $this->Html->link('Delete', ['action' => 'deleteTag', $tag->id], ['confirm' => 'Are you sure?']) ?>  
                </td>  
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>