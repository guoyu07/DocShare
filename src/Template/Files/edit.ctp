
	<div class="container-fluid"> 
		
		<div class="row" >
        <h1>Edit File</h1>
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


				$options = [];
				foreach($tags as $tag){
					$options[$tag->id] = $tag->value;
				}
				echo $this->Form->input('tags._ids',[
					'multiple' => 'checkbox',
					'options' => $options,
					'type'=>'select'
					]);
					
				echo $this->Form->button(__('Save Article'));
                echo $this->Form->end();
            ?>
        </div>
</div>