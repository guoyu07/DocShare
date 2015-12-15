
	<div class="container-fluid">  
		
		<div class="row">
        <h1>All Articles </h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Comments</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Status</th>
                <th>Allow Comments</th>
            </tr>

            <!-- Here is where we iterate through our $articles query object, printing out article info -->

            <?php foreach ($files as $file): ?>
            <tr>
                <td>
                    <?= $this->Html->link($file->title, ['action' => 'view', $file->id]) ?>       
                </td>                
                <td><?= $file->date ?></td>
                <td><?= $this->Html->link($file->commentCount, ['action' => 'comments', $file->id]) ?> </td>
                <td>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $file->id]) ?>       
                </td>
                <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $file->id],
                        ['confirm' => 'Are you sure?'])
                    ?>
                </td>
                <td>
                    
                    <?php 
//                       var_dump($article->publish);
                        if($file->publish){
                            echo $this->Form->postLink(
                                'Draft',
                                ['action' => 'draft', $file->id],
                                ['confirm' => 'Are you sure?']);
                        }else{
                            echo $this->Form->postLink(
                                'Publish',
                                ['action' => 'publish', $file->id],
                                ['confirm' => 'Are you sure?']);

                        }
    
                    ?>
                </td>
                <td>
                    
                    <?php 
//                       var_dump($article->publish);
                        if($file->commentsAllowed){
                            echo $this->Form->postLink(
                                'Block',
                                ['action' => 'block', $file->id],
                                ['confirm' => 'Are you sure?']);
                        }else{
                            echo $this->Form->postLink(
                                'Allow',
                                ['action' => 'allow', $file->id],
                                ['confirm' => 'Are you sure?']);

                        }
    
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>