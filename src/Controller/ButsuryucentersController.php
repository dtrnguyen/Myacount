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

        $shohinmei = array();
        $shohinmei += array(""=>"");
        foreach($this->Butsuryucenters->find()->where([""]) as $tmp){
		    $shohinmei+= array ($tmp->shohinmei=>$tmp->shohinmei);
		}
        $this->set("shohinmei",$shohinmei);

    }
    

        // Log::write('error',"this is debug");

        // Log::setConfig('test2', [
        //     'className' => 'File',
        //     'path' => LOGS,
        //     'levels' => ['error','debug'],
        //     'file' => 'test2.log',
        // ]);
        // $this->log('hello test',"error");
        // $this->log('hello debug',"debug");
        // //$this->log("ログの内容", '[ログレベル]');
        // $date =date('Y/m/d H:i:s');//当日付を表示
        // $this->log($date,"error");
        // $this->log('システムは使用出来ません',"emergency");//
        // $this->log('今すぐ行動する必要がある',"alert");
        // $this->log('致命的な状態',"critical");
        // $this->log('エラー状態',"error");
        // $this->log('警告状態',"warning");
        // $this->log('正常であるが、重大な状態',"notice");
        // $this->log('インフォメーションメッセージ',"info");
        // $this->log('デバッグレベルメッセージ',"debug");

    public function index()
    {   
        $this->_deletesession();

        $row = array(""=>"");
        $where = array();
        $where += array();
        $tmp = array();

        if($this->request->is('POST')){
            $searchvalue = $this->request->getdata();
            $this->_kensakuvalue(); 

            //optionsを作成するため条件を分ける
            $searchcompanyname = $searchvalue['companyname'];//会社名を検索
            $searchcompanyid = $this->request->getdata("companyid");//詳細画面から戻る会社名
            $searchtenpoid = $this->request->getdata("tenpoid");//詳細画面から戻る店舗名
              
            if($searchcompanyname!=""){
                $tmp += array("companyname like" => "%".$searchcompanyname."%");//検索後のoptions     
            }elseif(isset($searchcompanyid)){ 
                $tmp += array("companyname like" => "%".$searchcompanyid."%");//詳細画面から戻るoptions,会社名を検索時
            }elseif(isset($searchtenpoid)){
                $tmp += array("tenponame like" => "%".$searchtenpoid."%"); //詳細画面から戻るoptions,店舗名をを検索時                   
            }else{
                
            }
            //上の条件に沿って、optionsを表示(店舗名のDropdown)
            $tenponame = $this->Butsuryucenters
                ->find('all')
                ->select(["tenponame"=>"Butsuryucenters.tenponame"])
                -> where([$tmp])
                ->toList();
                foreach($tenponame as $value){
                    $option = $value["tenponame"];
                    $row = $row + array($option=>$option);
                }
                $tenponames = $row;
                $this->set('tenponames',$tenponames);        
            //検索の条件         
            foreach ($searchvalue as $key => $value ){//検索画面の条件 
                if($key == "companyname" || $key == "companytel" || $key == "companyaddress"||
                    $key == "tenponame" || $key == "tenpotel" || $key == "tenpoaddress" ||
                    $key == "shohinmei" || $key == "shurui" || $key == "kakaku" ||
                    $key == "unchintoraku" || $key == "tantosha" || 
                    $key == "nyukoubi" || $key == "shukoubi"){
                        $where += array ("CASE WHEN ".$key." IS NULL THEN '' ELSE ".$key." END LIKE" => "%".$value."%");
                }                                
                switch($key){//詳細画面から戻る時の検索の条件
                    case "companyid":
                    $where += array ("companyname LIKE" => "%".$value."");
                    break;
                    case "companytelid":
                    $where += array ("companytel LIKE" => "%".$value."%");
                    break;
                    case "companyaddressid":
                    $where += array("companyaddress LIKE" => "%".$value."%");    
                    break;
                    case "tenpoid":
                    $where += array ("tenponame LIKE" => "%".$value."%");
                    break;
                    case "tenpotelid":
                    $where += array("tenpotel LIKE" => "%".$value."%");    
                    break;
                    case "tenpoaddressid":
                    $where += array("tenpoaddress LIKE" => "%".$value."%");    
                    break;
                    case "shohinmeiid":
                    $where += array("shohinmei LIKE" => "%".$value."%");    
                    break;
                    case "shuruiid":
                    $where += array("shurui LIKE" => "%".$value."%");
                    break;
                    case "kakakuid":
                    $where += array("CASE WHEN kakaku IS NULL THEN '' ELSE kakaku END LIKE" => "%".$value."%");    
                    break;
                    case "unchintorakuid":
                    $where += array("unchintoraku LIKE" => "%".$value."%");    
                    break;
                    case "tantoshaid":
                    $where += array("tantosha LIKE" => "%".$value."%");    
                    break;
                    case "nyukouid":
                    $where += array("nyukoubi LIKE" => "%".$value."%");    
                    break;
                    case "shukouid":
                    $where += array("shukoubi LIKE" => "%".$value."%");
                    break;                   
                }                                                                               
            }             
            //検索結果
            $butsuryucenters =  $this->Butsuryucenters
                ->find()
                ->where([$where])
                ->order(['Butsuryucenters.id'=>'ASC']);      
                $this->set('butsuryucenters', $butsuryucenters);
        }           
    }

    public function _kensakuvalue()
    {  
        $searchvalue = $this->request->getData();

        $searchcompanyname = $searchvalue['companyname'];   
        $searchcompanytel = $searchvalue["companytel"];
        $searchcompanyaddress = $searchvalue["companyaddress"];
        $searchtenponame = $searchvalue['tenponame'];
        $searchtenpotel = $searchvalue["tenpotel"];
        $searchtenpoaddress = $searchvalue["tenpoaddress"];
        $searchshohinmei = $searchvalue["shohinmei"];
        $searchshurui = $searchvalue["shurui"];
        $searchkakaku = $searchvalue["kakaku"];
        $searchunchintoraku = $searchvalue["unchintoraku"]; 
        $searchtantosha = $searchvalue["tantosha"]; 
        $searchnyukoubi = $searchvalue["nyukoubi"]; 
        $searchshukoubi = $searchvalue["shukoubi"];  

        $searchcompanyid = $this->request->getdata("companyid");
        $searchcompanytelid = $this->request->getData("companytelid");
        $searchcompanyaddressid = $this->request->getData("companyaddressid");
        $searchtenpoid = $this->request->getdata("tenpoid");
        $searchtenpotelid = $this->request->getData("tenpotelid");
        $searchtenpoaddressid = $this->request->getData("tenpoaddressid");
        $searchshohinmeiid = $this->request->getdata("shohinmeiid");
        $searchshuruiid = $this->request->getData("shuruiid");
        $searchkakakuid = $this->request->getData("kakakuid");
        $searchunchintorakuid = $this->request->getData("unchintorakuid");
        $searchtantoshaid = $this->request->getData("tantoshaid");
        $searchnyukouid = $this->request->getData("nyukouid");
        $searchshukoubiid = $this->request->getData("shukouid");
           
        if(isset($searchcompanyname,$searchtenponame,
            $searchcompanytel,$searchcompanyaddress,$searchtenpotel,
            $searchtenpoaddress,$searchshurui,$searchshohinmei,
            $searchkakaku,$searchunchintoraku,$searchtantosha,
            $searchnyukoubi,$searchshukoubi)){
        
            $this->set('searchcompanyid',$searchcompanyname);
            $this->set('searchtenpoid',$searchtenponame);
            $this->set('searchcompanytel',$searchcompanytel);
            $this->set('searchcompanyaddress',$searchcompanyaddress);
            $this->set('searchtenpotel',$searchtenpotel);
            $this->set('searchtenpoaddress',$searchtenpoaddress);
            $this->set('searchshuruiid',$searchshurui);
            $this->set('searchshohinmeiid',$searchshohinmei);
            $this->set('searchkakakuid',$searchkakaku);
            $this->set('searchunchintorakuid',$searchunchintoraku);
            $this->set('searchtantoshaid',$searchtantosha);
            $this->set('searchnyukouid',$searchnyukoubi);
            $this->set('searchshukouid',$searchshukoubi);
        }else{  
            $this->set('searchcompanyid',$searchcompanyid); 
            $this->set('searchtenpoid',$searchtenpoid);               
            $this->set('searchcompanytelid',$searchcompanytelid);
            $this->set('searchcompanyaddressid',$searchcompanyaddressid);
            $this->set('searchtenpotelid',$searchtenpotelid);
            $this->set('searchtenpoaddressid',$searchtenpoaddressid);
            $this->set('searchshuruiid',$searchshuruiid);
            $this->set('searchshohinmeiid',$searchshohinmeiid);
            $this->set('searchkakakuid',$searchkakakuid);
            $this->set('searchunchintorakuid',$searchunchintorakuid);
            $this->set('searchtantoshaid',$searchtantoshaid);
            $this->set('searchnyukouid',$searchnyukouid);
            $this->set('searchshukouid',$searchshukoubiid);
        }
    }

	public function shouhin()
	{
    }

    public function edit()
    {
        $koshinmsg = "";
        $this->_edit();
        //検索画面から選択した行列のidを取得、そしてテーブルを作成する
        $postid = $this->request->getData("selectNo");
        $butsuryucenters = $this->Butsuryucenters
            ->find()
            ->where(["id"=>$postid]);
            $this->set('butsuryucenters',$butsuryucenters); 
        
        //上の取得したIDのデータが更新する
        $butsuryucenters = $this->Butsuryucenters->get($postid);
        if($this->request->is('post')){
            $data = $this->request->getData();
            $butsuryucenters = $this->Butsuryucenters->patchEntity($butsuryucenters, $data);
            if($this->Butsuryucenters->save($butsuryucenters)){
                $koshinmsg.= "<h3>更新されました</h3>";   
            }
            $this->set('koshinmsg',$koshinmsg);               
        }
    }


    public function add()
	{
        $torokumsg="";
        $this->_edit();
        //検索画面から選択する時のidを取得


        $post = $this->request->getData("selectid");
        if(isset($post)){
            $butsuryucenters = $this->Butsuryucenters
                ->find()
                ->where(["id"=>$post]);
                $this->set('butsuryucenters',$butsuryucenters);
        }else{

        }

        //検索画面からflg valueを取得、そして登録フォームに渡す
        $kensaku_flg = $this->request->getData("kensaku_flg");
        $this->set('toroku_flg',$kensaku_flg);

        //商品登録を行う
        if($this->request->is('post')){//=>なんで動くか確認する？
	        $data = $this->request->getData();
	        $butsuryucenters = $this->Butsuryucenters->newEmptyEntity();
	        $butsuryucenters = $this->Butsuryucenters->patchEntity($butsuryucenters, $data);
	        if($this->Butsuryucenters->save($butsuryucenters)){
                $torokumsg.= "<h2 class='torokumsg'>登録されました</h2>";
                $this->set('torokumsg',$torokumsg);

	            //新しいidを取得
	            $saveid = $this->Butsuryucenters->save($butsuryucenters)->id;
                $this->set('saveid',$saveid);

                //登録したflg value を取得、そして戻る条件のflg変数を作成
                $toroku_flg = $this->request->getData("toroku_flg");
                $this->set('kakunin_flg',$toroku_flg); 

	            //登録したidでテーブルを作成
	            $butsuryucenters = $this->Butsuryucenters->find()->where(["id"=>$saveid]);
	            $this->set('butsuryucenters',$butsuryucenters);
	            
           	}
        }
    }

    public function _edit()
    {
        
        $searchcompanyid = $this->request->getData("searchcompanyid");
        $searchcompanytelid = $this->request->getData("searchcompanytelid");
        $searchcompanyaddressid = $this->request->getData("searchcompanyaddressid");
        $searchtenpoid = $this->request->getData("searchtenpoid");
        $searchtenpotelid = $this->request->getData("searchtenpotelid");
        $searchtenpoaddressid = $this->request->getData("searchtenpoaddressid");
        $searchshohinmeiid = $this->request->getData("searchshohinmeiid");
        $searchshuruiid = $this->request->getData("searchshuruiid");
        $searchkakakuid = $this->request->getData("searchkakakuid");
        $searchunchintorakuid = $this->request->getData("searchunchintorakuid");
        $searchtantoshaid = $this->request->getData("searchtantoshaid");
        $searchnyukouid = $this->request->getData("searchnyukouid");
        $searchshukouid = $this->request->getData("searchshukouid");
        
        $this->set('companyid',$searchcompanyid);
        $this->set('companytelid',$searchcompanytelid);
        $this->set('companyaddressid',$searchcompanyaddressid);
        $this->set('tenpoid',$searchtenpoid);
        $this->set('tenpoaddressid',$searchtenpoaddressid);
        $this->set('tenpotelid',$searchtenpotelid);
        $this->set('shohinmeiid',$searchshohinmeiid);
        $this->set('shuruiid',$searchshuruiid);
        $this->set('kakakuid',$searchkakakuid);
        $this->set('unchintorakuid',$searchunchintorakuid);
        $this->set('tantoshaid',$searchtantoshaid);
        $this->set('nyukouid',$searchnyukouid);
        $this->set('shukouid',$searchshukouid);

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
            $result = $this->Butsuryucenters
                ->find()
                ->where(["companyname"=>$companyname,]);
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
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./files/sho5.xlsx');
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
        $file = 'sho5.xlsx'; //ファイル名
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
        $postid = $this->request->getData("editid");
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
        $this->set('file',$file);
        $this->set('spreadsheet',$spreadsheet);
    }

    

    private function _writesession()
    {

        $session = $this->request->getSession();
        $data = [
            "id"=>$this->request->getData("id"),
            "shouhinID"=>$this->request->getData("shouhinID"),
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
        $session->write('shouhinkanri',$data);
    }
    private function _readsession()
    {
        

        $session = $this->request->getSession();

        $shouhinkanri = $session->read('shouhinkanri');

        $this->set("id",$shouhinkanri["id"]);
        $this->set("shouhinID",$shouhinkanri["shouhinID"]);
        $this->set("companyname",$shouhinkanri["companyname"]);
        $this->set("companytel",$shouhinkanri["companytel"]);
        $this->set("companyaddress",$shouhinkanri["companyaddress"]);
        $this->set("tenponame",$shouhinkanri["tenponame"]);
        $this->set("tenpotel",$shouhinkanri["tenpotel"]);
        $this->set("tenpoaddress",$shouhinkanri["tenpoaddress"]);
        $this->set("shohinmei",$shouhinkanri["shohinmei"]);
        $this->set("shurui",$shouhinkanri["shurui"]);
        $this->set("kakaku",$shouhinkanri["kakaku"]);
		$this->set("unchintoraku",$shouhinkanri["unchintoraku"]);
		$this->set("tantosha",$shouhinkanri["tantosha"]);
        $this->set("nyukoubi",$shouhinkanri["nyukoubi"]);
        $this->set("shukoubi",$shouhinkanri["shukoubi"]); 
    }
    private function _deletesession()
    {
        $session=$this->request->getSession();
        $session->delete("kokyaku");
        $session->delete("usermaster");

    }
	
}