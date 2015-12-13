<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\network\Exception\InternalErrorException;
use Cake\Utility\Text;

/**
 * Upload Component
 */
 
 class UploadComponent extends Component
 {
	
	public function send($file){
		if(!empty($file)) {

//			
//			debug($file);

				$filename = $file['name'];
				$file_tmp_name = $file['tmp_name'];
//				$dir = WWW_ROOT.'img'.DS.'uploads';
				$dir = WWW_ROOT.'uploads';
				$allowed = array('png', 'jpg', 'jpeg');
				if(!in_array(substr(strrchr($filename , '.'), 1), $allowed)){
					throw new InternalErrorException("Error processing request.", 1);
				}elseif( is_uploaded_file($file_tmp_name)){
					move_uploaded_file($file_tmp_name, $dir.DS.$filename);
//					move_uploaded_file($file_tmp_name, $dir.DS.Text::uuid().'-'.$filename);
					}
				
		}
	}
}
 
 