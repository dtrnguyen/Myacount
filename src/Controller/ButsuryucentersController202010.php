<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Log\Log;
use Cake\Event\EventInterface;
use Cake\Datasource\ConnectionManager;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use setasign\Fpdi;
use setasign\Fpdi\Tcpdf;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpParser\Node\Expr\Print_;
use SplFileObject;

class ButsuryucentersController extends AppController

{
    public function initialize(): void
    {
        parent::initialize();
        $this->Kokyakuichirans = $this->gettableLocator()->get("kokyakuichirans");
        $this->Users = $this->getTableLocator()->get("users");
    }
    public function beforeFilter(EventInterface $event)
	{
	
		$companynames = array();
		$companynames += array(""=>"");
		foreach($this->Butsuryucenters->find()->group('companyname') as $tmp){
			$companynames+= array ($tmp->companyname =>$tmp->companyname);
		}
        $this->set("companynames",$companynames);

        $tenponames = array();
		$tenponames += array(""=>"");
		foreach($this->Butsuryucenters->find()->group('tenponame') as $tmp){
			$tenponames+= array ($tmp->tenponame=>$tmp->tenponame);
		}
        $this->set("tenponames",$tenponames);
	}
    public function index()
	{  
        Log::write('error',"this is debug");

        Log::setConfig('test2', [
            'className' => 'File',
            'path' => LOGS,
            'levels' => ['error','debug'],
            'file' => 'test2.log',
        ]);
        $this->log('hello test',"error");
        $this->log('hello debug',"debug");
        //$this->log("ログの内容", '[ログレベル]');
        $date =date('Y/m/d H:i:s');//当日付を表示
        $this->log($date,"error");
        $this->log('システムは使用出来ません',"emergency");//
        $this->log('今すぐ行動する必要がある',"alert");
        $this->log('致命的な状態',"critical");
        $this->log('エラー状態',"error");
        $this->log('警告状態',"warning");
        $this->log('正常であるが、重大な状態',"notice");
        $this->log('インフォメーションメッセージ',"info");
        $this->log('デバッグレベルメッセージ',"debug");

        $this->_readsession();
        $this->_deletesession();

        $row = array(""=>"");
        $where = array();
        $session = $this->request->getSession();
        $session_shouhin = $session->read('shouhin');
        if($this->request->is('POST')){
            $searchvalue = $this->request->getdata();
            $this->_writesession();
            $searchtmp = $this->request->getdata("companyid");
            if(isset($searchtmp)){
                $searchtmp = $this->request->getdata("companyid");
            }else{
                //$searchtmp = $searchvalue["companyname"];
            }

            if(isset($searchtpn)){
                $searchtpn = $this->request->getdata("tenpoid");
            }else{
                $searchtpn = $searchvalue["tenponame"];
            }
            if(isset($searchtmp)){
                $tenponames = $this->Butsuryucenters->find()
                ->select(["tenponame"=>"Butsuryucenters.tenponame"])
                ->where(["companyname"=>$searchtmp])
                ->toList();
                foreach($tenponames as $tenponame){
                    $row = $row + array($tenponame["tenponame"]=>$tenponame["tenponame"]);
                }
                $tenponames = $row;
                $this->set('tenponames',$tenponames);
            }
            
            if(!isset($searchvalue)){
                $searchvalue = $session_shouhin;
            }
            if($searchvalue["companyname"]!=""){
                var_dump($searchtmp);
                $tenponame = $this->Butsuryucenters->find()
                ->select(["tenponame"=>"Butsuryucenters.tenponame"])
                ->where(["companyname"=>$searchvalue["companyname"]])
                ->toList();
                foreach($tenponame as $value){
                    $row = $row + array($value["tenponame"]=>$value["tenponame"]);
                }
                $tenponames = $row;
                $this->set('tenponames',$tenponames);
            }
            if($searchvalue["tenponame"]==""&&$searchvalue["companyname"]==""&&isset($searchtpn)){
                $searchvalue = $session_shouhin;
                $tenponame = $this->Butsuryucenters->find()
                ->select(["tenponame"=>"Butsuryucenters.tenponame"])
                ->toList();
                foreach($tenponame as $value){
                    $row = $row + array($value["tenponame"]=>$value["tenponame"]);
                }
                $tenponames = $row;
                $this->set('tenponames',$tenponames);
            }
        }
    
            foreach($searchvalue as $key=>$value){
                if($key=="companyname"||$key=="tenponame"){
                    $where += array("CASE WHEN ".$key." IS NULL THEN '' ELSE ".$key." END like"=>"%".$value."%");
                }elseif($key=="companyid"){
                    $where += array("CASE WHEN companyname IS NULL THEN '' ELSE companyname END like"=>"%".$value."%");
                }
                $butsuryucenters = $this->Butsuryucenters->find('all')
                ->where([$where])
                ->order(["Butsuryucenters.id"=>"ASC"]);
                $this->set('butsuryucenters',$butsuryucenters);
            }
        
        
    }

    
	public function shouhin()
	{
    }

    public function edit()
    {
        $koshinmsg = "";
        $postid = $this->request->getData("id");
        $butsuryucenters = $this->Butsuryucenters->find()->where(["id"=>$postid]);
        $this->set('butsuryucenters',$butsuryucenters);
        $butsuryucenters = $this->Butsuryucenters->newEmptyEntity();
        if ($this->request->is('post')){
            $butsuryucenters = $this->Butsuryucenters->patchEntity($butsuryucenters, $this->request->getData());
            if($this->Butsuryucenters->save($butsuryucenters)){
                $koshinmsg.= "<h3>更新されました</h3>";   
            }
            
        }
        $this->set('koshinmsg',$koshinmsg);


       
    }
    public function add()
	{
        $torokumsg="";  
        if ($this->request->is('post')){
            $butsuryucenters = $this->Butsuryucenters->newEmptyEntity();
            $butsuryucenters = $this->Butsuryucenters->patchEntity($butsuryucenters, $this->request->getData());
            if($this->Butsuryucenters->save($butsuryucenters)){
                $torokumsg.= "<h2 class='torokumsg'>登録されました</h2>";
                $butsuryucenters = $this->Butsuryucenters->find()->where(["id"=>$this->Butsuryucenters->save($butsuryucenters)->id]);
                $this->set('butsuryucenters',$butsuryucenters);
                $this->set('torokumsg',$torokumsg);
                $this->log($butsuryucenters,"error");
            }
        }
            $post = $this->request->getData("torokuid");
            if(isset($post)){//$postが存在することを確認
                $butsuryucenters = $this->Butsuryucenters->find()->where(["id"=>$post]);
                $this->set('butsuryucenters',$butsuryucenters);
            }else{
                
            }
       
    }
    
    public function iframeindex()
    {
        $where = array(); 
        $butsuryucenters = array();
         $searchvalue="";
         $searchvalue=$this->request->getdata();
        foreach ($searchvalue as $key =>$value ){
            if($key=="companyname"||$key =="tenponame"){
                $where += array ("CASE WHEN ".$key." IS NULL THEN '' ELSE ".$key." END like" => "%".$value."%");                   
            }
        }
        if($this->request->is('POST')){
        $butsuryucenters =  $this->Butsuryucenters->find('all')->
       where([
            $where
        ])
        ->order([
                'Butsuryucenters.id'=>'ASC'
            ]);
        }      
        $this->set('butsuryucenters', $butsuryucenters);
	
    }
    public function findcompanyname()
    {
        $ret="";
		$this->layout = "ajax";
        if($this->request->is('ajax')){
            $companyname = $this->request->getdata("companyname");
			$result = $this->Butsuryucenters->find()->
            where(["companyname"=>$companyname,]);
            if(count($result->toArray())!=0){
                $ret .= '<option value=""></option>' . "\r\n";
            }
			foreach($result as $row){
				$ret .='<option value="'.$row["tenponame"].'">'.$row["tenponame"].'</option>'."\r\n";
            }
            echo $ret;
        }
    }

    public function findtenponame()
    {
        $ret="";
		$this->layout = "ajax";
		if($this->request->is(['ajax'])){
			$tenponame = $this->request->getdata("tenponame");
			$result = $this->Butsuryucenters->find()->
			where(["tenponame"=>$tenponame,
             ]);
             if(count($result->toArray())!=0){
                $ret .= '<option value=""></option>' . "\r\n";
            }
			foreach($result as $row){
				$ret .='<option value="'.$row["tenponame"].'">'.$row["tenponame"].'</option>'."\r\n";
			}
			echo $ret;
		}
    }

    public function download()
    {
        require_once '../vendor/autoload.php';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./files/sho2.xlsx');
        $sheet = $spreadsheet->getActiveSheet();

        $post = $this->request->getData();

        $sheet->setCellValue('B2', new \Datetime());

        for($i=1; $i<=count($post['Excel']);$i++){
            $cellnumber = 5 + $i;
            $db = $this->Butsuryucenters->find('all')
            ->select(["id"=>"Butsuryucenters.id",
                        "companyname"=>"Butsuryucenters.companyname",
                        "companytel"=>"Butsuryucenters.companytel",
                        "companyaddress"=>"Butsuryucenters.companyaddress",
                        "tenponame"=>"Butsuryucenters.tenponame",
                        "tenpotel"=>"Butsuryucenters.tenpotel",
                        "tenpoaddress"=>"Butsuryucenters.tenpoaddress",
                        "shohinmei"=>"Butsuryucenters.shohinmei",
                        "shurui"=>"Butsuryucenters.shurui",
                        "kakaku"=>"Butsuryucenters.kakaku",
                        "unchintoraku"=>"Butsuryucenters.unchintoraku",
                        "tantosha"=>"Butsuryucenters.tantosha",
                        "nyukoubi"=>"Butsuryucenters.nyukoubi",
                        "shukoubi"=>"Butsuryucenters.shukoubi"
            ])
            ->where(['Butsuryucenters.id'=>$post['Excel'][$i]])->first();
            $sheet->setCellValue('A'.$cellnumber, $db->id);
            $sheet->setCellValue('B'.$cellnumber, $db->companyname);
            $sheet->setCellValue('C'.$cellnumber, $db->companytel);
            $sheet->setCellValue('D'.$cellnumber, $db->companyaddress);
            $sheet->setCellValue('E'.$cellnumber, $db->tenponame);
            $sheet->setCellValue('F'.$cellnumber, $db->tenpotel);
            $sheet->setCellValue('G'.$cellnumber, $db->tenpoaddress);
            $sheet->setCellValue('H'.$cellnumber, $db->shohinmei);
            $sheet->setCellValue('I'.$cellnumber, $db->shurui);
            $sheet->setCellValue('J'.$cellnumber, $db->kakaku);
            $sheet->setCellValue('K'.$cellnumber, $db->unchintoraku);
            $sheet->setCellValue('L'.$cellnumber, $db->tantosha);
            $sheet->setCellValue('M'.$cellnumber, $db->nyukoubi);
            $sheet->setCellValue('N'.$cellnumber, $db->shukoubi);

        }
        $file = 'sho2.xlsx'; //ファイル名
        $date = new \Datetime; //time設定
        $date = $date->format('YmdHis');//time設定
        $derectory_path = "files/.$date";//保存状態が確認

        $writer = new Xlsx($spreadsheet);//新しいシートファイルが作成
        $writer->save($derectory_path.$file);//ダウンロードしたファイルがfilesに保存
        ob_end_clean();//出力用バッファの内容を消去し、出力のバッファリングをオフにします(xoa bo nho dem)

        $this->autoRender = false;
        //requestとはウェブブラウザからウェブサーバに要請したデータ（yeu cau lay du lieu tu server)
        $response = $this->response->withFile(//ウェブサーバからウェブブラウザに応答するデータ。(du lieu duoc tra ve browser tu server)
            $derectory_path. $file,
            ['download'=>true,
            'name'=>'商品一覧'.$date.'.xlsx']//ダウンロードファイル名とtimeが付ける
        );
        return $response;    
    }

    public function downloadtxt()
    {
        $file = 'textfile.txt';
        $date = new \Datetime;
        $date = $date->format('YmdHis');
        $derectory_path = "files/";
        $response = $this->response->withFile(
        $derectory_path. $file,
        [
            'download'=>true,
            'name'=>'textfile'.$date.'.txt'
        ]
        );
        return $response;
    }

    public function jidodownload()
    {
        require_once '../vendor/autoload.php';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./files/sho4.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $postid = $this->request->getData("id");
        var_dump($postid);
        $sheet->setCellValue('B2', new \Datetime());
        $db = $this->Butsuryucenters->find('all')
        ->where(['Butsuryucenters.id'=>$postid])->first();
        $sheet->setCellValue('A6', $db->id);
        $sheet->setCellValue('B6', $db->companyname);
        $sheet->setCellValue('C6', $db->companytel);
        $sheet->setCellValue('D6', $db->companyaddress);
        $sheet->setCellValue('E6', $db->tenponame);
        $sheet->setCellValue('F6', $db->tenpotel);
        $sheet->setCellValue('G6', $db->tenpoaddress);
        $sheet->setCellValue('H6', $db->shohinmei);
        $sheet->setCellValue('I6', $db->shurui);
        $sheet->setCellValue('J6', $db->kakaku);
        $sheet->setCellValue('K6', $db->unchintoraku);
        $sheet->setCellValue('L6', $db->tantosha);
        $sheet->setCellValue('M6', $db->nyukoubi);
        $sheet->setCellValue('N6', $db->shukoubi);

        $file = 'sho4.xlsx'; //ファイル名
        $date = new \Datetime; //time設定
        $date = $date->format('YmdHis');//time設定
        $derectory_path = "files/.$date";//保存状態が確認
        $writer = new Xlsx($spreadsheet);//新しいシートファイルが作成
        $writer->save($derectory_path.$file);//ダウンロードしたファイルがfilesに保存
        ob_end_clean();//出力用バッファの内容を消去し、出力のバッファリングをオフにします(xoa bo nho dem)
        $this->autoRender = false;
        //requestとはウェブブラウザからウェブサーバに要請したデータ（yeu cau lay du lieu tu server)
        $response = $this->response->withFile(//ウェブサーバからウェブブラウザに応答するデータ。(du lieu duoc tra ve browser tu server)
            $derectory_path. $file,
            ['download'=>true,
            'name'=>'商品一覧'.$date.'.xlsx']//ダウンロードファイル名とtimeが付ける
        );
        return $response;
    }

    private function _writesession()
    {
        $session = $this->request->getSession();
        $data=[
            "companyname"=>$this->request->getData("companyname"),
            "companytel"=>$this->request->getData("companytel"),
            "companyaddress"=>$this->request->getData("companyaddress"),
            "tenponame"=>$this->request->getData("tenponame"),
            "tenpotel"=>$this->request->getData("tenpotel"),
            "tenpoaddress"=>$this->request->getData("tenpoaddress"),
            "shohinmei"=>$this->request->getData("shohinmei"),
            "shurui"=>$this->request->getData("shurui"),
            "kakaku"=>$this->request->getData("kakaku"),
            "unchintoraku"=>$this->request->getData("unchintoraku"),
            "tantosha"=>$this->request->getData("tantosha"),
            "nyukoubi"=>$this->request->getData("nyukoubi"),
            "shukoubi"=>$this->request->getData("shukoubi"),
        ];
        $session->write('shouhin',$data);
    }
    private function _readsession()
    {
        
        $session=$this->request->getSession();
        
        $shouhin=$session->read('shouhin');
        $this->set("companyname",$shouhin["companyname"]);
        $this->set("companytel",$shouhin["companytel"]);
        $this->set("companyaddress",$shouhin["companyaddress"]);
        $this->set("tenponame",$shouhin["tenponame"]);
        $this->set("tenpotel",$shouhin["tenpotel"]);
        $this->set("tenpoaddress",$shouhin["tenpoaddress"]);
        $this->set("shohinmei",$shouhin["shohinmei"]);
        $this->set("shurui",$shouhin["shurui"]);
        $this->set("kakaku",$shouhin["kakaku"]);
		$this->set("unchintoraku",$shouhin["unchintoraku"]);
		$this->set("tantosha",$shouhin["tantosha"]);
        $this->set("nyukoubi",$shouhin["nyukoubi"]);
        $this->set("shukoubi",$shouhin["shukoubi"]);
        
    }
    private function _deletesession()
    {
        $session=$this->request->getSession();
        $session->delete("kokyaku");
        $session->delete("usermaster");

    }
	
}