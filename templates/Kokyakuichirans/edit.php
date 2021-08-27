<!DOCTYPE Html>
<html>
<head>
	<title>Henshin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?=$this->Html->css(['kokyakuhenshin'])?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<?php//<script src="/Myacount/webroot/js/kokyakuhenshin.js"> ?>
	
	<script>
	document.addEventListener('DOMContentLoaded',function(){

		$('#shouhinID',parent.document).val($('td.shouhinID').text());
		$('#companyname',parent.document).val($('td.companyname').text());
		$('#companytel',parent.document).val($('td.companytel').text());
		$('#companyaddress',parent.document).val($('td.companyaddress').text());
		$('#tenponame',parent.document).val($('td.tenponame').text());
		$('#tenpotel',parent.document).val($('td.tenpotel').text());
		$('#tenpoaddress',parent.document).val($('td.tenpoaddress').text());

		//$('#companyid',parent.document).val($('td.companyname').text());
	});
	$(document).on('click','.koshinbtn',function(){
		alert("本当に更新しますか？");
	});

	</script>
</head>
<body>
	<h1>顧客詳細</h1>
	<?php echo $koshinmsg;?>
	<hr>
	<div class="containers">
		<div class="container-left">
		<?=$this->Form->create(null,['type'=>'post',
										'url'=>['controller'=>'Kokyakuichirans','action'=>'edit']])?>
		<?=$this->Form->hidden("shousaiid",["id"=>"shousaiid"])?>
		<?=$this->Form->control("shouhinID",["type"=>"text",
										"id"=>"shouhinID",
										"label"=>"商品ID",						

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
										"id"=>"tenponame",
										"label"=>"店舗名",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("tenpotel",["type"=>"text",
										"id"=>"tenpotel",
										"label"=>"店舗TEL",
		])?>
		<?=$this->Form->control("tenpoaddress",["type"=>"text",
										"id"=>"tenpoaddress",
										"label"=>"店舗住所",
										"class"=>"input-class",
		])?>
		</div>
	
		<div class="containerbtn">
			<?=$this->Form->submit("更新",["class"=>"koshinbtn"])?>
			<?=$this->Form->end()?>

			<?= $this->Form->create(null,['type'=>'post',
											'url'=>["controller"=>"Kokyakuichirans",
											"action"=>"index"]])?>
			<?//<?=$this->Form->hidden("companyid",["id"=>"companyid"])?>
			<?= $this->Form->button('戻る',['class'=>'backbtn'])?>
			<?= $this->Form->end()?>
		</div>
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