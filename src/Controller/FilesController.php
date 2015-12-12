<?php

// src/Controller/filesController.php

namespace App\Controller;
use App\Controller\AppController;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Event\Event;



class FilesController extends AppController
{
	var $uses = array('file', 'Comment'); 

	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('all');
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
			if ($this->files->isOwnedBy($fileId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}
	
	
	
	
    public function all()
    {
        $files = $this->Files->find('all')->contain([
			'Comments' => function ($q) {
							   return $q
									->select()
									->where(['Comments.approved' => true]);
							}
				]);
        $this->set(compact('files'));
    }
    public function index()
    {
//        $files = $this->files->find('all');
//        $this->set(compact('files'));
//		 $files=TableRegistry::get('files');

        $files = $this->files->find('all')->contain(['Comments']);
        $this->set(compact('files'));

    }
    
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $file = $this->files->get($id);
        if ($this->files->delete($file)) {
            $this->Flash->success(__('The file with id: {0} has been deleted.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
    public function draft($id)
    {
        $this->request->allowMethod(['post', 'draft']);

        $file = $this->files->get($id);
        $file['publish'] = "False";
        if ($this->files->save($file)) {
            $this->Flash->success(__('The file with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
     public function publish($id)
    {
        $this->request->allowMethod(['post', 'publish']);

        $file = $this->files->get($id);
        $file['publish'] = "True";
        if ($this->files->save($file)) {
            $this->Flash->success(__('The file with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
    public function block($id)
    {
//        $this->request->allowMethod(['post', 'block']);
		$filesTable = TableRegistry::get('files');

        $file = $filesTable->get($id);
        $file['commentsAllowed'] = false;
        if ($filesTable->save($file)) {
            $this->Flash->success(__('The file with id: {0} has been updated.', h($id)));
            return $this->redirect($this->referer());
        }
    }
    
     public function allow($id)
    {
        $filesTable = TableRegistry::get('files');

        $file = $filesTable->get($id);
        $file['commentsAllowed'] = true;
        if ($filesTable->save($file)) {
            $this->Flash->success(__('The file with id: {0} has been updated.', h($id)));
            return $this->redirect($this->redirect($this->referer()));
        }
    }
    public function login()
    {
        if ($this->request->is('post')) {
            $login = $this->request->data;
//            print_r($login);
            if($login['username'] == 'admin' && $login['password'] == 'conestoga'){
                    $this->Flash->success(__('Successfully Logged In.'));
                    return $this->redirect($this->referer());
                }
            
            $this->Flash->error(__('Please Enter Right Credentials.'));
        }
    }
    
    
    public function view($id)
    {
		$filesTable = TableRegistry::get('files');
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
		$filesTable = TableRegistry::get('files');
		$file = $filesTable->get($id); // Return file with id 12

		$file->commentCount += 1;
		$filesTable->save($file);
		return $this->redirect('/files/view/'.$id);

	}
	
	public function comments($id){
		$commentsTable = TableRegistry::get('Comments');
		$comments = $commentsTable->find('all', array('conditions' => array('file_id' => $id)));
        $this->set(compact('comments'));
	}

    public function edit($id){
			$tagsTable = TableRegistry::get('Tags');
			$tags = $tagsTable->find('all');
			$this->set(compact('tags'));

		
			$filesTable = TableRegistry::get('files');
            $file = $filesTable->get($id, ['contain' => 'Tags']);

			$tempfile = $this->request->data;
            if ($this->request->is(['post', 'put'])) {
                $this->files->patchEntity($file, $this->request->data,[
				'associated' => [
					'Tags'
				]
				
				]);
				
						if($this->files->save($file)){
							 $this->Flash->success(__('Your tag pair has been saved.'));
						}
						$this->Flash->error(__('Unable to create relation of file and tag.'));
					}


            $this->set('file', $file);
        }

    public function add()
    {

		$now = Time::now();

		$tagsTable = TableRegistry::get('Tags');
		$filestagsTable = TableRegistry::get('filesTags');
		$filesTable = TableRegistry::get('files');
		$count = $filesTable->find('all');
		$newfileId = $count->last()->id +1;
        $query = $this->files->Tags->find('list', [
				'keyField' => 'id',
				'valueField' => 'value'
			]);
			$tags = $query->toArray();
			$this->set(compact('tags'));

		
		
        $file = $this->files->newEntity();
        if ($this->request->is('post')) {
            $tempfile = $this->request->data;
            $file = $this->files->patchEntity($file, $this->request->data);
			$file->user_id = $this->Auth->user('id');
			$file->date = $now;
			$tuple = $filestagsTable->newEntity();
			$flag = $filestagsTable->findAllByfileId($newfileId);
			$flagCount = $flag->count();
			if($flagCount>0)
			{
//				print("flag found");
			}else{
//								print("flag not found");

				foreach($tempfile['Tags'] as $tag):
						
						$tuple->file_id= $newfileId;
						$tuple->tag_id= $tag;					
						if($filestagsTable->save($tuple)){
							 $this->Flash->success(__('Your tag pair has been saved.'));
						}
						$this->Flash->error(__('Unable to create relation of file and tag.'));
				endforeach;
				
				if ($this->files->save($file)) {
					$this->Flash->success(__('Your file has been saved.'));
					return $this->redirect($this->referer());
				}
				$this->Flash->error(__('Unable to add your file.'));
			}
			
            
        }
        $this->set('file', $file);
    }
}
?>