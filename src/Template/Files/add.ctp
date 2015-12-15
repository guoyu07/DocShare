
	<div class="container-fluid">        
		
		<div class="row" >
        <h1>Add Article</h1>
            <?php
                echo $this->Form->create($file, ['type' => 'file']);
				echo $this->Form->file("upfile");
                echo $this->Form->input('content', ['rows' => '15']);
                echo $this->Form->input('publish', array('type' => 'checkbox', 'name' => 'publish'));
                echo $this->Form->input('comments', array('type' => 'checkbox', 'name' => 'comments'));
				

                echo $this->Form->button(__('Save'));
                echo $this->Form->end();
            ?>
        </div>
</div>