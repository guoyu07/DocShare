<?php


namespace App\Model\Table;
use Cake\ORM\Table;

class FilesTagsTable extends Table
{
	

    public function initialize(array $config)
    {
		
        $this->addBehavior('Timestamp');

        $this->belongsTo('Files', [
            'foreignKey' => 'file_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
            'joinType' => 'INNER'
        ]);
		 
    }
}


?>