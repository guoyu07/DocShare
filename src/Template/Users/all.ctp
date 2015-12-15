
	<div class="container-fluid">        
		
		<div class="row">
        <h1> Users </h1>
        <table>
            <tr>
                <th>UserName</th>
                <th>Role</th>
                <th>Delete</th>
            </tr>

            <!-- Here is where we iterate through our $articles query object, printing out article info -->
			<?php foreach ($users as $user): 
			?>
            <tr>
                <td>
                    <?= $user->username ?>       
                </td>                
                <td><?= $user->role ?></td>
                <td><?
				if($this->request->session()->read('Auth.User.role') == 'admin' && $this->request->session()->read('Auth.User.id') != $user->id){
						echo $this->Html->link('Delete', ['controller' => 'Users','action' => 'delete', $user->id]);

			}else{
						echo "---";
			}
					?>
				</td>
            </tr>
			<?php endforeach; ?>
        </table>
    </div>
</div>