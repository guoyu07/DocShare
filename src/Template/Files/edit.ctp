
	<div class="container-fluid"> 
		
		<div class="row" >
        <h1>Edit Article</h1>
            <?php
                echo $this->Form->create($file);
                echo $this->Form->label('title:');
                echo $this->Form->label('title', $file->title);
                echo $this->Form->input('content', ['rows' => '5']);    
				
				echo $this->Form->input('publish', array(
									'label' => __('Publish',true),
									'type' => 'checkbox'));
									



                echo $this->Form->input('commentsAllowed', array(
									'type' => 'checkbox', 
									'label' => 'Allow Comments'));


					
				echo $this->Form->button(__('Save Article'));
                echo $this->Form->end();
            ?>
        </div>
</div>