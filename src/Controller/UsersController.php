<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add','logout']);
    }
    public function index()
    {
        Log::setConfig('testuser',[
            'className'=>'File',
            'path'=>LOGS,
            'levels'=>['error'],
            //'scopes'=>['orders','testuser'],
            'file'=>'testuser.log',
        ]);
        $this->log('check log user',"error");
        $this->_readsession();

        $where = array(); 
        $users = array();
        $session=$this->request->getSession();
        $session->delete("kokyaku");
        $session->delete("shouhinkanri");
        $session_usermaster=$session->read('usermaster');
        if($this->request->is('POST')){
            $searchvalue = $this->request->getdata();
            $this->_writesession();
        }
        if(count($searchvalue)==0){
            $searchvalue= $session_usermaster;
        }
        foreach($searchvalue as $key =>$value ){
            if($key != "usermaster"){
                $where += array ("CASE WHEN ".$key." IS NULL THEN '' ELSE ".$key." END like" => "%".$value."%"); 
            }                 
            $users = $this->Users->find('all')->select()->
            where([
                $where
            ])
            ->order([
                'Users.id'=>'ASC'
            ]);
        }
        $this->set('users',$users);
    }

    public function add()
    {
        $torokumsg="";
        $user = $this->Users->newEmptyEntity();
        if($this->request->is('post')){
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if($this->Users->save($user)){
                $torokumsg.="<div class='torokumsg'>登録されました</div>";
            }else{
                foreach($user->getErrors() as $errors){
                    foreach($errors as $error){
                        $torokumsg.="<div class='torokumsg'>$error</div>";
                    }
                }
            }
        }
        $this->set('user',$user);
        $this->set('torokumsg',$torokumsg);
    }

    public function edit()
    {
        // $koshinmsg = "";
        // $post = $this->request->getData("id");
        // $users = $this->Users->find()->where(["id"=>$post]);
        // $this->set('users',$users);
        // $users = $this->Users->get($post);
        // if($this->request->is('post')){
	    //     $users = $this->Users->patchEntity($users, $this->request->getData());
	    //     if($this->Users->save($users)){
	    //         $koshinmsg.= "<div class='koshinmsg'>更新されました</div>";
	    //     }
        // }
        // $this->set('koshinmsg',$koshinmsg);
        
        $koshinmsg = "";
        $post = $this->request->getData("id");
        $users = $this->Users->find()->Where(["id"=>$post]);
        $this->set('users',$users);
       
        if($this->request->is('post')){
            $users = $this->Users->get($post);
            $users = $this->Users->patchEntity($users,$this->request->getData());
            if($this->Users->save($users)){
                $koshinmsg.= "<div class='koshinmsg'>更新されました</div>";
            }
            $this->set('koshinmsg',$koshinmsg);
        }
        
    }

    public function login()
    {
        Log::setConfig('testuser',[
            'className'=>'File',
            'path'=>LOGS,
            'levels'=>['error'],
            //'scopes'=>['orders','testuser'],
            'file'=>'testuser.log',
        ]);
        $errormsg="";
        if($this->request->is('post')){
            $user = $this->Auth->identify();   
            if($user){
                $this->Auth->setUser($user);
                $username = $this->request->getsession()->read('Auth.User.username');
                $this->log("login success with userID:".$username ,"error");
                return $this->redirect($this->Auth->RedirectUrl());   
            }else{
                $this->log("login not success: password or user not exit","error");
                $errormsg.= "<div class='errormsg'>ユーザー名又はパスワードを違います</div>";
            }
        }
        $this->set('errormsg',$errormsg);
    }

    public function logout()
    {
        $this->_deletesession();
        $username = $this->request->getsession()->read('Auth.User.username');
        $this->log("logout success by userID:".$username,"error");
        return $this->redirect($this->Auth->logout());
    }
    private function _writesession()
    {
        $session=$this->request->getSession();
        $data=[
            "userID"=>$this->request->getData("userID"),
            "username"=>$this->request->getData("username"),
        ];
        $session->write('usermaster',$data);
        
    }
    private function _readsession()
    {
        
        $session=$this->request->getSession();
        
        $usermaster=$session->read('usermaster');
        $this->set("userID",$usermaster["userID"]);
        $this->set("username",$usermaster["username"]);
    }

    private function _deletesession()
    {
        $session=$this->request->getSession();
        $session->delete("kokyaku");
        $session->delete("shouhinkanri");
        $session->delete("usermaster");
    }
}
