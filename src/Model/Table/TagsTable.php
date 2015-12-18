<?php


namespace App\Model\Table;
use Cake\ORM\Table;

class TagsTable extends Table
{
	

    public function initialize(array $config)
    {
		$this->addBehavior('Timestamp');

		$this->belongsToMany('Files', [
            'joinTable' => 'files_tags',
			'dependent' => true,

        ]);

    }
}


?>