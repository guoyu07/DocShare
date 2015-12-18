
	<div class="container-fluid">        
		
		<div class="row">
        <h1> All Tags </h1>
        <table>
            <tr>
                <th>Value</th>
                <th>slug</th>
				<th>Files</th>
            </tr>

            <!-- Here is where we iterate through our $articles query object, printing out article info -->

            <?php foreach ($tags as $tag): ?>
            <tr>
                <td> <?= $this->Html->link($tag->value,  ['action' => 'viewall', $tag->id]) ?>  
</td>                
                <td><?= $tag->slug ?> </td>    
				<td> <?= $this->Html->link('View',  ['action' => 'viewall', $tag->id]) ?>  
</td>
				 
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>