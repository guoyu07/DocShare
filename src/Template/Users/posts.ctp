
	<div class="container-fluid">        
		
		<div class="row">
        <h1> Files </h1>
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
			<?php foreach ($users as $user): ?>
			<?php if($user->id = $this->request->session()->read('Auth.User.id')) { 
			foreach ($user['files'] as $file): ?>
            <tr>
                <td>
                    <?= $this->Html->link($file->title, ['controller' => 'files', 'action' => 'view', $file->id]) ?>       
                </td>                
                <td><?= $file->date ?></td>
                <td><?= $this->Html->link($file->commentCount, ['controller' => 'files','action' => 'comments', $file->id]) ?> </td>
                <td>
                    <?= $this->Html->link('Edit', ['controller' => 'files','action' => 'edit', $file->id]) ?>       
                </td>
                <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['controller' => 'files','action' => 'delete', $file->id],
                        ['confirm' => 'Are you sure?'])
                    ?>
                </td>
                <td>
                    
                    <?php 
//                       var_dump($article->publish);
                        if($file->publish){
                            echo $this->Form->postLink(
                                'Draft',
                                ['controller' => 'files','action' => 'draft', $file->id],
                                ['confirm' => 'Are you sure?']);
                        }else{
                            echo $this->Form->postLink(
                                'Publish',
                                ['controller' => 'files','action' => 'publish', $file->id],
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
                                ['controller' => 'files','action' => 'block', $file->id],
                                ['confirm' => 'Are you sure?']);
                        }else{
                            echo $this->Form->postLink(
                                'Allow',
                                ['controller' => 'files','action' => 'allow', $file->id],
                                ['confirm' => 'Are you sure?']);

                        }
    
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
			<?php } ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>