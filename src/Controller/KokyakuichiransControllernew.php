<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;
use App\Model\Entity\Kokyakuichiran;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;


class KokyakuichiransController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Butsuryucenters = $this->getTableLocator()->get("butsuryucenters");
    }
    public function beforeFilter(EventInterface $event)
	{
		$companynames = array();
		$companynames += array(""=>"");
		foreach($this->Kokyakuichirans->find()->group('companyname') as $tmp){
			$companynames+= array ($tmp->companyname =>$tmp->companyname);
		}
        $this->set("companynames",$companynames);

        $tenponames = array();
		$tenponames += array(""=>"");
		foreach($this->Kokyakuichirans->find()->group('tenponame') as $tmp){
			$tenponames+= array ($tmp->tenponame=>$tmp->tenponame);
		}
        $this->set("tenponames",$tenponames);

        $shouhinIDs = array();
        $shouhinIDs += array(""=>"");
        foreach($this->Kokyakuichirans->find()->group('shouhinID') as $tmp){
        	$shouhinIDs += array ($tmp->shouhinID=>$tmp->shouhinID);
        }
        $this->set("shouhinIDs",$shouhinIDs);

        $shouhinIDmax = max($shouhinIDs);//最新のshouhinIDが確認する為
        if($shouhinIDmax<9){
        	$shouhinIDlast = "00".++$shouhinIDmax;
		}elseif(9<=$shouhinIDmax&&$shouhinIDmax<99){
			$shouhinIDlast = "0".++$shouhinIDmax;
		}elseif($shouhinIDmax&&$shouhinIDmax>=99){
			$shouhinIDlast = ++$shouhinIDmax;
		}else{
			$shouhinIDlast = ++$shouhinIDmax;
		}
        $this->set("shouhinIDlast",$shouhinIDlast);
	
	}
    public function index()
    {
        Log::setConfig('testkokyakujouhou',[
            'className'=>'File',
            'path'=>LOGS,
            'levels'=>'info',
            'file'=>'testkokyakujouhou.log'
        ]);
        $this->_readsession();
        $this->_deletesession();

        $ret = array(""=>"");
        $where = array(); 
        $kokyakuichirans = array();
        $session=$this->request->getSession();
        $session_kokyaku=$session->read('kokyaku');

    
        if($this->request->is('POST')){
            $searchvalue = $this->request->getdata();
            $this->_writesession();
            $searchtmp = $this->request->getdata("companyid");
            if($searchvalue["companyname"]!=""){
                $this->_writesession();
                $tenponame = $this->Kokyakuichirans->find()->
                select(["tenponame"=>"Kokyakuichirans.tenponame"])->
                where(["companyname"=>$searchvalue["companyname"]])->toList();

                foreach($tenponame as $value){
                    $ret = $ret + array($value["tenponame"]=>$value["tenponame"]);
                }
                $tenponame = $ret;
                $this->set('tenponames',$tenponame); 
            }elseif(isset($searchtmp)){
                $tenponame = $this->Kokyakuichirans->find()->
                select(["tenponame"=>"Kokyakuichirans.tenponame"])->
                where(["companyname"=>$searchtmp])->toList();

                foreach($tenponame as $value){
                    $ret = $ret + array($value["tenponame"]=>$value["tenponame"]);
                }
                $tenponame = $ret;
                $this->set('tenponames',$tenponame); 
            }
            // if(isset($searchtmp)){
            //     $tenponame = $this->Kokyakuichirans->find()->
            //     select(["tenponame"=>"Kokyakuichirans.tenponame"])->
            //     where(["companyname"=>$searchtmp])->toList();

            //     foreach($tenponame as $value){
            //         $ret = $ret + array($value["tenponame"]=>$value["tenponame"]);
            //     }
            //     $tenponame = $ret;
            //     $this->set('tenponames',$tenponame); 
            // }
                
        

        if(count($searchvalue)==0){
            $searchvalue=$session_kokyaku;

        }
    }
        
        
            // if(count($searchvalue)==0){
            //     $searchvalue=$session_kokyaku;
            //     $tenponame = $this->Kokyakuichirans->find()->
            //     select(["tenponame"=>"Kokyakuichirans.tenponame"])->
            //     where(["companyname"=>$searchvalue["companyname"]])->toList();
            //     foreach($tenponame as $value){
            //         $ret = $ret + array($value["tenponame"]=>$value["tenponame"]);
            //     }
            //     $tenponame = $ret;
            //     $this->set('tenponames',$tenponame);   
            // }

            // $searchtmp = $this->request->getdata("companyid");
            // $tenponame = $this->Kokyakuichirans->find()->
            // select(["tenponame"=>"Kokyakuichirans.tenponame"])->
            // where(["shouhinID"=>$this->request->$searchtmp])->toList();
            // foreach($tenponame as $value){
            //     $ret = $ret + array($value["tenponame"]=>$value["tenponame"]);
            // }
            // $tenponame = $ret;
            // $this->set('tenponames',$tenponame);   
        
            
        foreach($searchvalue as $key =>$value ){
            if($key == "companyname"||$key == "tenponame"){
                $where += array ("CASE WHEN ".$key." IS NULL THEN '' ELSE ".$key." END like" => "%".$value."%"); 
            }elseif($key == "companyid"&&$searchvalue["companyname"]!=""){
                $where += array ("CASE WHEN companyname IS NULL THEN '' ELSE companyname END like" => "%".$value."%"); 
            }
            $kokyakuichirans = $this->Kokyakuichirans->find('all')->select()->
            where([
                $where
            ])
            ->order([
                'Kokyakuichirans.id'=>'ASC'
            ]);
        }
        $this->set('kokyakuichirans',$kokyakuichirans);
    
    }

    public function add()
    {
        $torokumsg="";
        $post = $this->request->getData("torokuid");
        if(isset($post)){//$postが存在することを確認
            $kokyakuichirans = $this->Kokyakuichirans->find()->where(["id"=>$post]);
            $this->set('kokyakuichirans',$kokyakuichirans);
        }else{ 

        }
        if($this->request->is('post')){  
            $kokyakuichirans = $this->request->getdata();
            $kokyakuichirans = $this->Kokyakuichirans->newEntity($kokyakuichirans);   
            if ($this->Kokyakuichirans->save($kokyakuichirans)){
                $torokumsg.="<div class='torokumsg'>登録されました</div>";
                $kokyakuichirans = $this->Kokyakuichirans->find()->where(["id"=>$this->Kokyakuichirans->save($kokyakuichirans)->id]);
                $this->set('kokyakuichirans',$kokyakuichirans);
            }else{
                foreach($kokyakuichirans->getErrors() as $errors){
                    foreach($errors as $error){
                        $torokumsg.="<div class='torokumsg'>$error</div>"; 
                    }
                }
            }
            $this->set('torokumsg',$torokumsg);
        }
     }

    public function edit()
    {
        $koushinmsg = "";
        $post = $this->request->getData("shousaiid");
        $kokyakuichirans = $this->Kokyakuichirans->find()->where(["id"=>$post]);
        $this->set('kokyakuichirans',$kokyakuichirans);
        $kokyakuichirans = $this->Kokyakuichirans->newEmptyEntity();
        if ($this->request->is('post')) {
            $kokyakuichirans = $this->Kokyakuichirans->patchEntity($kokyakuichirans, $this->request->getData());
            if($this->Kokyakuichirans->save($kokyakuichirans)){
                $connection = ConnectionManager::get('default');
                $updatesql="UPDATE butsuryucenters set shouhinID=?,companyname=?,companytel=?,companyaddress=?,tenponame=?,tenpotel=?,tenpoaddress=? where shouhinID=?;";
                //$updatesql2="UPDATE kokyakuichirans set shouhinID=?,companyname=?,companytel=?,companyaddress=?,tenponame=?,tenpotel=?,tenpoaddress=? where shouhinID=?;";
                $updatearray=[$kokyakuichirans->shouhinID,$kokyakuichirans->companyname,$kokyakuichirans->companytel,$kokyakuichirans->companyaddress,$kokyakuichirans->tenponame,$kokyakuichirans->tenpotel,$kokyakuichirans->tenpoaddress,$kokyakuichirans->shouhinID];
                $connection->execute($updatesql,$updatearray);
                //$connection->execute($updatesql2,$updatearray);
                $koushinmsg.="<h3>更新されました</h3>";
            }
        }
        $this->set('koshinmsg',$koushinmsg);
    }
    public function iframeindex()
    {
        $where = array(); 
        $kokyakuichirans = array();
         $searchvalue="";
         $searchvalue=$this->request->getdata();
        foreach ($searchvalue as $key =>$value ){
            if($key=="companyname"||$key =="tenponame"){
                $where += array ("CASE WHEN ".$key." IS NULL THEN '' ELSE ".$key." END like" => "%".$value."%");                   
            }
        }
        if($this->request->is('POST')){
        $kokyakuichirans =  $this->Kokyakuichirans->find('all')->select()->
        where([
            $where
        ])
        ->order([
                'Kokyakuichirans.id'=>'ASC'
            ]);
        }      
        $this->set('kokyakuichirans', $kokyakuichirans);
    }

    public function findcompany()
    {
        //$session=$this->request->getSession();
        Log::setConfig('testkokyakujouhou',[
            'className'=>'File',
            'path'=>LOGS,
            'levels'=>'info',
            'file'=>'testkokyakujouhou.log'
        ]);

        $ret="";
		$this->layout = "ajax";
		if($this->request->is(['ajax'])){
            $companyname = $this->request->getdata("companyname");
			$result = $this->Kokyakuichirans->find()->
			where(["companyname"=>$companyname,
            ]);
            if(count($result->toArray())!=0){
                $ret .= '<option value=""></option>' . "\r\n";
            }
			foreach($result as $row){
				$ret .='<option value="'.$row["tenponame"].'">'.$row["tenponame"].'</option>'."\r\n";
            }
            echo $ret;

            $session = $this->request->getSession();
            $data=[
            "tenponame"=>$this->request->getData("tenponame"),
            ];
            $session->write($data);
            $this->_writesession();
            
            
            $this->set('ret',$ret);

            $this->log("check ajax:".$row,"info");
        }

        
    }

    public function findtenpo()
    {
        $ret="";
		$this->layout = "ajax";
		if($this->request->is(['ajax'])){
			$tenponame = $this->request->getdata("tenponame");
			$result = $this->Kokyakuichirans->find()->
			where(["tenponame"=>$tenponame,
			 ]);

			foreach($result as $row){
				$ret .='<option value="'.$row["shouhinID"].'">'.$row["tenponame"].'</option>'."\r\n";
			}
			echo $ret;
		}
    }

    private function _writesession()
    {
        $session = $this->request->getSession();
        $data=[
            "companyname"=>$this->request->getData("companyname"),
            "tenponame"=>$this->request->getData("tenponame"),
        ];
        $session->write('kokyaku',$data);
    }
    private function _readsession()
    {
        
        $session=$this->request->getSession();
        $kokyaku=$session->read('kokyaku');
        $this->set("companyname",$kokyaku["companyname"]);
        $this->set("tenponame",$kokyaku["tenponame"]);
        
    }
    public function _deletesession()
    {
        $session=$this->request->getSession();
        $session->delete("shouhin");
        $session->delete("usermaster");
    }
}


