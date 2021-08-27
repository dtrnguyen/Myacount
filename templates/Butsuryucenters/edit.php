<!DOCTYPE Html>
<html>
<head>
	<title>Henshin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	 <?php //echo '<META name http-equiv="Refresh" CONTENT="2; URL=/Myacount/Butsuryucenters/downloadtxt(filedownloadlink)/" >';
	 ?>

	
	<?=$this->Html->css(['henshin'])?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		window.onload = function(){
			$('#id',parent.document).val($('td.id').text());
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


			//$("#downloadgg").submit();
		}

		$(document).on('click','.koshinbtn',function(){
			alert("本当に更新しますか？");
		});



	</script>
</head>
<body>
	<h1>商品情報</h1><?php echo $koshinmsg;?>
	<hr>
	
	<div class="container">
		<div class="container-left">
		<?=$this->Form->create(null,['type'=>'post',
										'url'=>['controller'=>'Butsuryucenters',
										'action'=>'edit']])?>
		<?=$this->Form->hidden("selectNo",["id"=>"selectNo"])?>				
		<?=$this->Form->control("companyname",["type"=>"text",
										"id"=>"companyname",
										"label"=>"会社名",
										"readonly"=>"readonly",					
										"class"=>"input-class left-style",

		])?>
		<?=$this->Form->control("companytel",["type"=>"text",
										"id"=>"companytel",
										"label"=>"会社TEL",
										"readonly"=>"readonly",											
										"class"=>"input-class left-style",

		])?>
		<?=$this->Form->control("companyaddress",["type"=>"text",
										"label"=>"会社住所",
										"readonly"=>"readonly",										
										"class"=>"input-class left-style",

		])?>
		<?=$this->Form->control("tenponame",["type"=>"text",
										"label"=>"店舗名",
										"readonly"=>"readonly",	
										"class"=>"input-class left-style",

		])?>
		<?=$this->Form->control("tenpotel",["type"=>"text",
										"label"=>"店舗TEL",
										"readonly"=>"readonly",	
										"class"=>"input-class left-style",

		])?>
		<?=$this->Form->control("tenpoaddress",["type"=>"text",
										"label"=>"店舗住所",
										"readonly"=>"readonly",	
										"class"=>"input-class left-style",

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
			<div class="container-btn">
							
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
				<?=$this->Form->submit("更新",["class"=>"koshinbtn"])?>
				<?=$this->Form->end()?>

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

				<?= $this->Form->create(null,['type'=>'post','id'=>'downloadgg',
										'url'=>['controller'=>'Butsuryucenters',
										'action'=>'jidodownload']])?>				
				<?=$this->Form->hidden("editid",["id"=>"editid"])?>
				<?= $this->Form->end()?>

			</div>
		</div>

		
	
		<div class="shouhinichiran">
        <table>
            <tr>
				<th class="id">id</th>
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
				<td class="id"><?=h($butsuryucenter->id)?></td>
				<td class="shouhinID"><?=h($butsuryucenter->shouhinID)?></td>
				<td class="companyname"><?=h($butsuryucenter->companyname)?></td>
				<td class="companytel"><?=(h($butsuryucenter->companytel))?></td>
				<td class="companyaddress"><?=h($butsuryucenter->companyaddress)?></td>
				<td class="tenponame"><?=h($butsuryucenter->tenponame)?></td>
				<td class="tenpotel"><?=h($butsuryucenter->tenpotel)?></td>
				<td class="tenpoaddress"><?=h($butsuryucenter->tenpoaddress)?></td>
				<td class="shohinmei"><?=h($butsuryucenter->shohinmei)?></td>
				<td class="shurui"><?=h($butsuryucenter->shurui)?></td>
				<td class="kakaku"><?=(h($butsuryucenter->kakaku))?></td>
				<td class="unchintoraku"><?=h($butsuryucenter->unchintoraku)?></td>
				<td class="tantosha"><?=h($butsuryucenter->tantosha)?></td>
				<td class="nyukoubi"><?=($butsuryucenter->nyukoubi)?></td>
				<td class="shukoubi"><?=h($butsuryucenter->shukoubi)?></td>
			</tr>
			<?php endforeach ;?>
        </table>
	</div>
	
</body>
</html>