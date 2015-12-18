<?php

// src/Controller/FilesController.php

namespace App\Controller;
use App\Controller\AppController;
use App\Controller\Component;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\network\Exception\InternalErrorException;





class FilesController extends AppController
{
	var $uses = array('File', 'Comment'); 

	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('all');
    }
 
	public function initialize(){
		parent::initialize();
		$this->loadComponent('Upload');
	}
	
	
	public function isAuthorized($user)
	{
		print($this->request->action);
		// All registered users can add files
		if ($this->request->action === 'add') {
			return true;
		}
		

		// The owner of an file can edit and delete it
		if (in_array($this->request->action, ['edit', 'delete'])) {
			$fileId = (int)$this->request->params['pass'][0];
			if ($this->Files->isOwnedBy($fileId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}
	
	
	
	
    public function all()
    {
		$files = $this->Files->find('all', array('conditions' => array('publish' => true)))->contain([
				'Comments' => function ($q) {
								   return $q
										->where(['Comments.approved' => true]);
								}
					]);
        $this->set(compact('files'));
    }
	
    public function index()
    {
        $files = $this->Files->find('all');
        $this->set(compact('files'));

    }
    
    public function delete($id)
    {
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The File with id: {0} has been deleted.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
    public function draft($id)
    {
        $file = $this->Files->get($id);
        $file['publish'] = false;
        if ($this->Files->save($file)) {
            $this->Flash->success(__('The File with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
     public function publish($id)
    {

        $file = $this->Files->get($id);
        $file['publish'] = true;
        if ($this->Files->save($file)) {
            $this->Flash->success(__('The File with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
    public function block($id)
    {
        $file = $this->Files->get($id);
        $file['commentsAllowed'] = false;
        if ($this->Files->save($file)) {
            $this->Flash->success(__('The File with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
     public function allow($id)
    {

        $file = $this->Files->get($id);
        $file['commentsAllowed'] = true;
        if ($this->Files->save($file)) {
            $this->Flash->success(__('The File with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
   
    
    
    public function view($id)
    {
		$filesTable = TableRegistry::get('Files');
		$files = $filesTable->find('all', array('conditions' => array('id' => $id)))->contain([
			'Comments' => function ($q) {
							   return $q
									->select()
									->where(['Comments.approved' => true]);
							}
				]);
        $this->set(compact('files'));
    }
	
	public function increasecomment($id){
		$filesTable = TableRegistry::get('Files');
		$file = $filesTable->get($id);
		$file->commentCount += 1;
		$filesTable->save($file);
		return $this->redirect($this->referer());

	}
	
	public function comments($id){		
		$filesTable = TableRegistry::get('Files');
        $file = $filesTable->get($id, ['contain' => 'Comments']);
		        $this->set(compact('file'));

	}

    public function edit($id){
		
		$tagsTable = TableRegistry::get('Tags');
			$tags = $tagsTable->find('all');
			$this->set(compact('tags'));
		
		
			$filesTable = TableRegistry::get('Files');
            $file = $filesTable->get($id, ['contain' => 'Tags']);
			$file->title = urldecode($file->title);
            if ($this->request->is(['post', 'put'])) {
                $this->Files->patchEntity($file, $this->request->data);
				
						if($this->Files->save($file)){
							 $this->Flash->success(__('Your tag pair has been saved.'));
						}
						$this->Flash->error(__('Unable to create relation of article and tag.'));
					}


            $this->set('file', $file);
        }

	public function add(){
		
			$now = Time::now();
			$tagsTable = TableRegistry::get('Tags');
			$tags = $tagsTable->find('all');
			$this->set(compact('tags'));
		
		
			$file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            $tempFile = $this->request->data;
            $file = $this->Files->patchEntity($file, $this->request->data,[
				'associated' => [
					'Tags'
				]
				
				]);
			
			$file->user_id = $this->Auth->user('id');
			$file->date = $now;
			$file->uniqueID = Text::uuid();
			$file->title = urlencode($file["upfile"]["name"]);
			if(!empty($file["upfile"])){
				$filename = $file["upfile"]['name'];
				$file_tmp_name = $file["upfile"]['tmp_name'];
				$dir = WWW_ROOT.'uploads';
				$allowed = array('png', 'jpg', 'jpeg','doc','txt','pdf','mp4','swf','sql','rpt');

				if(!in_array(substr(strrchr($filename , '.'), 1), $allowed)){
					throw new InternalErrorException("Error processing request.", 1);
				}elseif( is_uploaded_file($file_tmp_name)){
					move_uploaded_file($file_tmp_name, $dir.DS.$file->uniqueID.'-'.$filename);
					}
			}
			
			if ($this->Files->save($file)) {
					$this->Flash->success(__('Your file has been saved.'));
					return $this->redirect($this->referer());
				}
			$this->Flash->error(__('Unable to add your file.'));
			

		}

			
			
            $this->set('file', $file);
      }

	
	
}
?>