<?php
namespace App\Controller;
use App\Controller\AppController;
use App\Controller\Component;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\network\Exception\InternalErrorException;

class TagsController extends AppController {
    
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('all');
    }
	
	
	public function index()
    {
        $this->set('tags', $this->paginate($this->Tags));
        $this->set('_serialize', ['tags']);
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		$filestagsTable = TableRegistry::get('FilesTags');
        $filesArray = $filestagsTable->find('all', array('conditions' => array('tag_id' => $id)))->contain([
			'Files' => function ($q) {
								   return $q
										->where(['Files.user_id' => $this->Auth->user('id')]);
								}
		]);
		
		
		$this->set(compact('filesArray'));
    }
	
	public function viewall($id = null)
    {
		$filestagsTable = TableRegistry::get('FilesTags');
        $filesArray = $filestagsTable->find('all', array('conditions' => array('tag_id' => $id)))->contain([
			'Files']);
		
		
		$this->set(compact('filesArray'));
    }

	 public function all()
    {
		$this->set('tags', $this->paginate($this->Tags));
        $this->set('_serialize', ['tags']);
    }
    
    public function add()
    {
		$tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tempTag = $this->request->data;
			$tempTag['slug'] = urlencode($tempTag['value']);
            $tag = $this->Tags->patchEntity($tag, $tempTag);
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('Tag created successfully.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable save your comment.'));
        }
        $this->set('tag', $tag);
    }
    
//  public function index()
//    {
//	  	$tagsTable = TableRegistry::get('Tags');
//
//        $tags = $tagsTable->find('all');
//        $this->set(compact('tags'));
//  	}
   public function deleteTag($id){
		
		$tag = $this->Tags->get($id, [
			'contain' => 'Files'
			]);
//	   debug($tag);
	   if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The Tag has been deleted.'));
            return $this->redirect($this->referer());
        }
	}
   
}
?>