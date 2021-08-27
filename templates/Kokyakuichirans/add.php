<!DOCTYPE Html>
<html>
<head>
	<title>Kokyakutoroku</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?=$this->Html->css(['kokyakutorokus'])?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/Myacount/webroot/js/kokyakutoroku.js"></script>

	<style>
		body{
    background-color:lightblue;
}
h1{
    text-align:center;
    color:Blue;
}
.torokumsg{
    color: red;
    text-align: center;
    font-size:35px;
}
h4{
    font-size: 25px;
    text-align: center;
    color: red;
    margin-top:-40px;
}

hr{
    width:80%;
}
.container{
    width:1200px;
    margin:0 auto;
    margin-bottom:100px;
}

.container .container-left{
    width:700px;
    float:left;
}
.container .container-right{
    width:500px;
    float:left;
}

.torokubtn{
    width:80px;
    height:40px;
    border-radius:10px;
    background-color:LightGreen;
    cursor:pointer;
    display:block;
}
.backbtn{
    width:80px;
    height:40px;
    border-radius:10px;
    background-color:LightGreen;
    cursor:pointer;
    display:block;
    margin-top:-49px;
    margin-left:1190px;
}
.containerbtn{
    width:100%;
    float:right;
}
.input-class{
    width: 550px;
    height: 35px;
}

input{
    width: 350px;
    height: 35px;
    border: outset;
    border-radius: 8px;
    margin:10px;
    margin-left: 10px;
}
label{
    width:350px;
    height: 25px;
    margin-bottom:-10px;
    margin-left: 12px;
    background-color:moccasin;
    border-radius: 6px;
    display: block;
}
/* table{
	display: none;
} */

	</style>
</head>
<body>
	<h1>顧客登録</h1><?php echo $torokumsg; ?>
	<hr>
    <br>
    
	<div class="container">
		<div class="container-left">
        <?=$this->Form->create(null,['type'=>'post',
										   'url'=>['controller'=>'Kokyakuichirans','action'=>'add']])?>					   
		<?=$this->Form->control("shouhinID",["type"=>"text",
										"id"=>"shouhinID",
										"label"=>"商品ID",
										"value"=>$shouhinIDlast,							
		])?>
		<?=$this->Form->control("companyname",["type"=>"text",
										"id"=>"companyname",                                      
										"label"=>"会社名",								
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("companytel",["type"=>"text",
										"id"=>"companytel",
										"label"=>"会社TEL",										
		])?>
		<?=$this->Form->control("companyaddress",["type"=>"text",
										"id"=>"companyaddress",
										"label"=>"会社住所",										
										"class"=>"input-class",
        ])?>
		</div>
        <div class="container-right">
		<?=$this->Form->control("tenponame",["type"=>"text",
										"label"=>"店舗名",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("tenpotel",["type"=>"text",
										"label"=>"店舗TEL",
		])?>
		<?=$this->Form->control("tenpoaddress",["type"=>"text",
										"label"=>"店舗住所",
										"class"=>"input-class",
		])?>
		</div>
	</div>
	<div class="containerbtn">
		<?=$this->Form->submit("登録",["class"=>"torokubtn"])?>
		<?=$this->Form->end()?>
	
		<?= $this->Form->create(null,['type'=>'post',
									'url'=>['controller'=>'Kokyakuichirans',
									'action'=>'index']])?>
		<?= $this->Form->submit('戻る',['class'=>'backbtn',])?>
		<?= $this->Form->end()?>
    </div>
    <div class="kokyakuichirans">
        <table>
            <tr>
				<th class="shouhinID">shouhinID<th>
				<th class="companyname">Companyname</th>
				<th class="companytel">Companytel</th>
				<th class="companyaddress">Companyaddress</th>
				<th class="tenponame">Tenponame</th>
				<th class="tenpotel">Tenpotel</th>
				<th class="tenpoaddress">Tenpoaddress</th>
			</tr>
			<?php foreach($kokyakuichirans as $kokyakuichiran):?>
            <tr>
				<td class="shouhinID"><?=h($kokyakuichiran->shouhinID)?></td>
				<td class="companyname"><?=h($kokyakuichiran->companyname)?></td>
				<td class="companytel"><?=h($kokyakuichiran->companytel)?></td>
				<td class="companyaddress"><?=h($kokyakuichiran->companyaddress)?></td>
				<td class="tenponame"><?=h($kokyakuichiran->tenponame)?></td>
				<td class="tenpotel"><?=h($kokyakuichiran->tenpotel)?></td>
				<td class="tenpoaddress"><?=h($kokyakuichiran->tenpoaddress)?></td>
			</tr>
			<?php endforeach ;?>
        </table> 
    </div>
</body>
</html>