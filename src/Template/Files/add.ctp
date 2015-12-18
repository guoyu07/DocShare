
	<div class="container-fluid">        
		
		<div class="row" >
        <h1>Add File</h1>
            <?php
                echo $this->Form->create($file, ['type' => 'file']);
				echo $this->Form->file("upfile");
                echo $this->Form->input('content', ['rows' => '15']);
                echo $this->Form->input('publish', array('type' => 'checkbox', 'name' => 'publish'));
                echo $this->Form->input('comments', array('type' => 'checkbox', 'name' => 'comments'));
				
//				echo $this->Form->input("Tags", array("multiple" => "checkbox", "options" => $tags));
				
				$options = [];
				foreach($tags as $tag){
					$options[$tag->id] = $tag->value;
				}
				echo $this->Form->input('tags._ids',[
					'multiple' => 'checkbox',
					'options' => $options,
					'type'=>'select'
					]);
                echo $this->Form->button(__('Save'));
                echo $this->Form->end();
            ?>
        </div>
</div>