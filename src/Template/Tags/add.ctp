
	
<div class="container-fluid">  

		<div class="row" >
        <h1>Add Tag</h1>
            <?php
                echo $this->Form->create($tag);
                echo $this->Form->input('value');
                echo $this->Form->button(__('Save'));
                echo $this->Form->end();
            ?>
        </div>
</div>