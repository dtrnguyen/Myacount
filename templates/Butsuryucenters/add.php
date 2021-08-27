<!DOCTYPE Html>
<html>
<head>
	<title>Touroku</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?=$this->Html->css(['shouhintoroku'])?>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<?php//<script src="/Myacount/webroot/js/shouhintoroku.js"></script>?>
	<script>
		
		window.onload = function(){
			$('#shouhinID',parent.document).val($('td.shouhinID').text());
			$('#companyname',parent.document).val($('td.companyname').text());
			$('#companytel',parent.document).val($('td.companytel').text());
			$('#companyaddress',parent.document).val($('td.companyaddress').text());
			$('#tenponame',parent.document).val($('td.tenponame').text());
			$('#tenpotel',parent.document).val($('td.tenpotel').text());
			$('#tenpoaddress',parent.document).val($('td.tenpoaddress').text());
			$('#shohinmei',parent.document).val($('td.shohinmei').text());
			$('#shurui',parent.document).val($('td.shurui').text());
			$('#kakaku',parent.document).val($('td.kakaku').text());
			$('#unchintoraku', parent.document).val($('td.unchintoraku').text());
			$('#tantosha',parent.document).val($('td.tantosha').text());
			$('#nyukoubi',parent.document).val($('td.nyukoubi').text());
			$('#shukoubi', parent.document).val($('td.shukoubi').text());
		}

	</script>

</head>
<body>
	<h1>商品登録</h1><?php echo $torokumsg ?>
	<hr>
	<div class="container">
		<div class="iframeclass">
			<iframe src="/Myacount/Kokyakuichirans/iframeindex" id="kaisha-shitenmei"width="350" height="450" frameborder="0" allowfullscreen><?php//scrolling="no"?>
			</iframe>
		</div>
		<div class="container-left">
		<?=$this->Form->create($butsuryucenters,['type'=>'post',
										'url'=>['controller'=>'Butsuryucenters',
										'action'=>'add']
		])?>
		<?php //ここにはhidden("id",["id"=>"id"])が入れば新しい登録が出来ない?>
		<?=$this->Form->hidden("shouhinID",["id"=>"shouhinID"])?>
		<?=$this->Form->control("companyname",["type"=>"text",
										"label"=>"会社名",								
										"class"=>"input-class left-style",
										"readonly"=>"readonly",
		])?>
		<?=$this->Form->control("companytel",["type"=>"text",
										"label"=>"会社TEL",										
										"class"=>"input-class left-style",
										"readonly"=>"readonly",
		])?>
		<?=$this->Form->control("companyaddress",["type"=>"text",
										"label"=>"会社住所",										
										"class"=>"input-class left-style",
										"readonly"=>"readonly",
		])?>
		<?=$this->Form->control("tenponame",["type"=>"text",
										"label"=>"店舗名",
										"class"=>"input-class left-style",
										"readonly"=>"readonly",
		])?>
		<?=$this->Form->control("tenpotel",["type"=>"text",
										"label"=>"店舗TEL",
										"class"=>"input-class left-style",
										"readonly"=>"readonly",
		])?>
		<?=$this->Form->control("tenpoaddress",["type"=>"text",
										"label"=>"店舗住所",
										"class"=>"input-class left-style",
										"readonly"=>"readonly",
		])?>
		</div>
		<div class="container-center">
		<?=$this->Form->control("shohinmei",["type"=>"text",								
										"label"=>"商品名",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("shurui",["type"=>"text",
										"label"=>"種類",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("kakaku",["type"=>"text",
										"label"=>"価格",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("unchintoraku",["type"=>"text",
										"label"=>"運賃トラック",
										"class"=>"input-class",
		])?>
		</div>
		<div class="container-right">
		<?=$this->Form->control("tantosha",["type"=>"text",
										"label"=>"担当者",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("nyukoubi",["type"=>"text",
										"label"=>"入庫日",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("shukoubi",["type"=>"text",
										"label"=>"出庫日",
										"class"=>"input-class",								
		])?>
		</div>
	</div>
	<div class="containerbtn">

		<?=$this->Form->hidden("toroku_flg",["value"=>$toroku_flg])?>
		<?=$this->Form->hidden("companyid",["value"=>$companyid])?>
		<?=$this->Form->hidden("companytelid",["value"=>$companytelid])?>
		<?=$this->Form->hidden("companyaddressid",["value"=>$companyaddressid])?>
		<?=$this->Form->hidden("tenpoid",["value"=>$tenpoid])?>
		<?=$this->Form->hidden("tenpotelid",["value"=>$tenpotelid])?>
		<?=$this->Form->hidden("tenpoaddressid",["value"=>$tenpoaddressid])?>
		<?=$this->Form->hidden("shohinmeiid",["value"=>$shohinmeiid])?>
		<?=$this->Form->hidden("shuruiid",["value"=>$shuruiid])?>
		<?=$this->Form->hidden("kakakuid",["value"=>$kakakuid])?>
		<?=$this->Form->hidden("unchintorakuid",["value"=>$unchintorakuid])?>
		<?=$this->Form->hidden("tantoshaid",["value"=>$tantoshaid])?>
		<?=$this->Form->hidden("nyukouid",["value"=>$nyukouid])?>
		<?=$this->Form->hidden("shukouid",["value"=>$shukouid])?>
		<?=$this->Form->submit("登録",["class"=>"torokubtn"])?>
		<?=$this->Form->end()?>
	
		<?php echo $kakunin_flg; ?>
		<?php echo "<br>"; ?>
		<?php echo "Hello World" ;?>
		<?php echo "<br>"; ?>
		<?php echo $toroku_flg; ?>

		<?php if($toroku_flg==1||$kakunin_flg==1){?>
		<?= $this->Form->create(null,['type'=>'post',
									'url'=>['controller'=>'Butsuryucenters',
									'action'=>'index']])?>	
		<?=$this->Form->hidden("companyid",["value"=>$companyid])?>
		<?=$this->Form->hidden("companytelid",["value"=>$companytelid])?>
		<?=$this->Form->hidden("companyaddressid",["value"=>$companyaddressid])?>
		<?=$this->Form->hidden("tenpoid",["value"=>$tenpoid])?>
		<?=$this->Form->hidden("tenpotelid",["value"=>$tenpotelid])?>
		<?=$this->Form->hidden("tenpoaddressid",["value"=>$tenpoaddressid])?>
		<?=$this->Form->hidden("shohinmeiid",["value"=>$shohinmeiid])?>
		<?=$this->Form->hidden("shuruiid",["value"=>$shuruiid])?>
		<?=$this->Form->hidden("kakakuid",["value"=>$kakakuid])?>
		<?=$this->Form->hidden("unchintorakuid",["value"=>$unchintorakuid])?>
		<?=$this->Form->hidden("tantoshaid",["value"=>$tantoshaid])?>
		<?=$this->Form->hidden("nyukouid",["value"=>$nyukouid])?>
		<?=$this->Form->hidden("shukouid",["value"=>$shukouid])?>
		<?= $this->Form->submit('戻る',['class'=>'backbtn'])?>
		<?= $this->Form->end()?>
		<?php }else{?>
			<?= $this->Form->create(null,["type"=>"get",
									'url'=>['controller'=>'Butsuryucenters',
									'action'=>'index']])?>
		<?= $this->Form->submit('戻る',['class'=>'backbtn'])?>
		<?= $this->Form->end()?>
		<?php }?>

	</div>
	<div class="shouhinichiran">
        <table>
            <tr>
				<th class="shouhinID">shouhinID</th>
				<th class="companyname">Companyname</th>
				<th class="companytel">Companytel</th>
				<th class="companyaddress">Companyaddress</th>
				<th class="tenponame">Tenponame</th>
				<th class="tenpotel">Tenpotel</th>
				<th class="tenpoaddress">Tenpoaddress</th>
				<th class="shohinmei">Shohinmei</th>
                <th class="shurui">Shurui</th>
                <th class="kakaku">Kakaku</th>
                <th class="unchintoraku">Unchintoraku</th>
                <th class="tantosha">Tantosha</th>
                <th class="nyukoubi">Nyukoubi</th>
                <th class="shukoubi">Shukoubi</th>  
			</tr>
			<?php foreach($butsuryucenters as $butsuryucenter):?>
            <tr>
				<td class="shouhinID"><?=h($butsuryucenter->shouhinID)?></td>
				<td class="companyname"><?=h($butsuryucenter->companyname)?></td>
				<td class="companytel"><?=h($butsuryucenter->companytel)?></td>
				<td class="companyaddress"><?=h($butsuryucenter->companyaddress)?></td>
				<td class="tenponame"><?=h($butsuryucenter->tenponame)?></td>
				<td class="tenpotel"><?=h($butsuryucenter->tenpotel)?></td>
				<td class="tenpoaddress"><?=h($butsuryucenter->tenpoaddress)?></td>
				<td class="shohinmei"><?=h($butsuryucenter->shohinmei)?></td>
				<td class="shurui"><?=h($butsuryucenter->shurui)?></td>
				<td class="kakaku"><?=h($butsuryucenter->kakaku)?></td>
				<td class="unchintoraku"><?=h($butsuryucenter->unchintoraku)?></td>
				<td class="tantosha"><?=h($butsuryucenter->tantosha)?></td>
				<td class="nyukoubi"><?=h($butsuryucenter->nyukoubi)?></td>
				<td class="shukoubi"><?=h($butsuryucenter->shukoubi)?></td>			
			</tr>
			<?php endforeach ;?>
        </table>
	</div>
</body>
</html>