<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'DocShare';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

	    <?= $this->Html->css('bootstrap.min.css') ?>
	    <?= $this->Html->css('main.css') ?>
	    <?= $this->Html->css('w3.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	
    <section class="clearfix container-fluid">
		<header>
		<?= "<h1>".$this->Html->link('DocShare', ['controller' => 'files', 'action' => 'all'])."</h1>" ?>
		<div class="row">
			<div class="menu">
				<? if($this->request->session()->read('Auth.User.id') > 0){ ?>
					<?	if($this->request->controller == "Users" && $this->request->action == "all"){ ?>
						<div class="customLink col-sm-1">
							<?= $this->Html->link('Add Admin', ['controller' => 'Users', 'action' => 'addadmin']) ?>

						</div>
					<? }else { ?>
						<div class="customLink col-sm-1">
							<?= $this->Html->link('Add File', ['controller' => 'Files', 'action' => 'add']) ?>

						</div>
					<? } ?>
						<div class="dashboard col-sm-1">
							<?= $this->Html->link('Dashboard', ['controller' => 'users', 'action' => 'dashboard']) ?>

						</div>
						<div class="articles col-sm-1">
							<?= $this->Html->link('Files', ['controller' => 'users','action' => 'posts']) ?>
						</div>
						<?php 
							if($this->request->session()->read('Auth.User.role') == 'admin'){ 
						?>
								<div class="users col-sm-1">
									<?= $this->Html->link('Users', ['controller' => 'users', 'action' => 'all']) ?>
								</div>
								<div class="comments col-sm-1">
									<?= $this->Html->link('Comments', ['controller' => 'Comments', 'action' => 'index']) ?>
								</div>
								<div class="tags col-sm-1">
									<?= $this->Html->link('Tags', ['controller' => 'Tags','action' => 'index']) ?>
								</div>	
						<?php } ?>
						<div class="logout col-sm-1">
							<?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?>
						</div>
				<?	}else{ ?>
						<div class="login col-sm-1">
						<?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?>
						</div>
						<div class="customLink col-sm-1">
							<?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'add']) ?>

						</div>
				<?	} ?>
			</div>
		</div>
		
	</header>
		
        	<?= $this->fetch('content') ?>

    </section>
    <footer>
    </footer>
</body>
</html>
