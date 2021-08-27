<!DOCTYPE Html>
<html>
<head>
	<title>Shouhinichirans</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?=$this->Html->css(['shouhinichiran.css'])?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		function check(){
			var hidden = document.getElementById("selectNo").value;
			if(hidden == ""){
				window.alert("商品名を選んでください");
				return false;
			}else{
				return true;
			}		
		}
		function checkjouhou(){
			window.alert("情報が存在しない");
			return false;
		}
		$(document).on('click', 'tr', function(){
			var toroku = $(this).children("td.id").text();
			document.getElementById("selectid").value = toroku;
			var koushin = $(this).children("td.id").text();
			document.getElementById("selectNo").value = koushin;
		});
		$(document).on('click', 'td', function(){
			var clsName = 'selectrow';
			var tmpTr = $(this).parents('tr');
			if ( !tmpTr.hasClass(clsName) ) {
				$(tmpTr).parents('table').find('tr').removeClass(clsName);
				$(tmpTr).addClass(clsName);
			}
		});
		$(function(){
			$('#companyname').change(function(){
				var csrf = $('input[name=_csrfToken]').val();
				$.ajax({
					type:'post',
					url:'/Myacount/Butsuryucenters/findcompanyname',
					beforeSend: function(xhr){
					xhr.setRequestHeader('X-CSRF-Token',csrf);
					},
					data:{companyname:$("#companyname").val(),
					}
					}).done(function(data){
					console.log(data);
					$("#tenponame").html(data);
				}).fail(function(){
					alert('エラーが発生しました。');
				});
			})
		});

		
	// $(function(){
	// 	$('companyname').change(function(){
	// 		$('#searchtenpoid').val($('#tenponame').selected);
	// 	})
	// });


		// $(document).ready(function(){
		// 	$("#download5").submit();
		// });
	
	</script>
</head>
<body>
	<h1>商品一覧</h1>
	<hr>
	<div class="container">
		<div class="container-left">
		<?=$this->Form->create(null,['type'=>'post',
										'url'=>['controller'=>'Butsuryucenters','action'=>'index']
		])?>
		
		<?=$this->Form->control("companyname",["type"=>"select",
										"options"=>$companynames,										
										"default"=>$searchcompanyid,
										"id"=>"companyname",
										"label"=>"会社名",										
										"class"=>"input-class left-style",
		])?>
		<?=$this->Form->control("companytel",["type"=>"text",
		    							"default"=>$searchcompanytelid,
										"label"=>"会社TEL",										
										"class"=>"input-class left-style",
		])?>
		<?=$this->Form->control("companyaddress",["type"=>"text",
		                                 "default"=>$searchcompanyaddressid,
										"label"=>"会社住所",									
										"class"=>"input-class left-style",
		])?>
		<?=$this->Form->control("tenponame",["type"=>"select",
										"options"=>$tenponames,
										"default"=>$searchtenpoid,
										"id"=>"tenponame",								
										"label"=>"店舗名",
										"class"=>"input-class left-style",
		])?>
		<?=$this->Form->control("tenpotel",["type"=>"text",
										"default"=>$searchtenpotelid,
										"label"=>"店舗TEL",
										"class"=>"input-class left-style",
		])?>
		<?=$this->Form->control("tenpoaddress",["type"=>"text",
										"default"=>$searchtenpoaddressid,
										"label"=>"店舗住所",
										"class"=>"input-class left-style",
		])?>
		</div>
		<div class="container-center">
		<?=$this->Form->control("shohinmei",["type"=>"text",
										"default"=>$searchshohinmeiid,							
										"label"=>"商品名",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("shurui",["type"=>"text",
		 								"default"=>$searchshuruiid,
										"label"=>"種類",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("kakaku",["type"=>"text",
										"default"=>$searchkakakuid,
										"label"=>"価格",
										"class"=>"input-class",
		])?>	
		<?=$this->Form->control("unchintoraku",["type"=>"text",
										"default"=>$searchunchintorakuid,
										"label"=>"運賃トラック",
										"class"=>"input-class",
		])?>
		</div>
		<div class="container-right">
		<?=$this->Form->control("tantosha",["type"=>"text",
										"value"=>$searchtantoshaid,
										"label"=>"担当者",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("nyukoubi",["type"=>"text",
										"default"=>$searchnyukouid,
										"label"=>"入庫日",
										"class"=>"input-class",
		])?>
		<?=$this->Form->control("shukoubi",["type"=>"text",
		                                 "default"=>$searchshukouid,
										"label"=>"出庫日",
										"class"=>"input-class",
		])?>
		</div>
	</div>
	<div class="container-btn">
		<?php $t = 0 ?>
		<?php $kensaku_flg = 0?>
		<?php foreach ($butsuryucenters as $butsuryucenter):?>
		<?php $t += 1;?>
		<?php if($t == 1){
			$kensaku_flg = 1;
		}?>
		<?php endforeach;?>
		<?=$this->Form->submit("検索",["class"=>"kensakubtn"])?>
		<?=$this->Form->end()?>
	
		<?= $this->Form->create(null,['type'=>'post',
										'url'=>['controller'=>'Butsuryucenters',
													'action'=>'add'],])?>
		<?=$this->Form->hidden("kensaku_flg",["default"=>$kensaku_flg]);?>
		<?=$this->Form->hidden("selectid",["id"=>"selectid"])?>
		
		<?=$this->Form->hidden("searchcompanyid",["id"=>"searchcompanyid","default"=>$searchcompanyid])?>
		<?=$this->Form->hidden("searchcompanytelid",["id"=>"searchcompanytelid","default"=>$searchcompanytelid])?>
		<?=$this->Form->hidden("searchcompanyaddressid",["id"=>"searchcompanyaddressid","default"=>$searchcompanyaddressid])?>
		<?=$this->Form->hidden("searchtenpoid",["id"=>"searchtenpoid","default"=>$searchtenpoid])?>
		<?=$this->Form->hidden("searchtenpoaddressid",["id"=>"searchtenpoaddressid","default"=>$searchtenpoaddressid])?>
		<?=$this->Form->hidden("searchtenpotelid",["id"=>"searchtenpotelid","default"=>$searchtenpotelid])?>	
		<?=$this->Form->hidden("searchshohinmeiid",["id"=>"searchshohinmeiid","default"=>$searchshohinmeiid])?>
		<?=$this->Form->hidden("searchshuruiid",["id"=>"searchshuruiid","default"=>$searchshuruiid])?>
		<?=$this->Form->hidden("searchkakakuid",["id"=>"searchkakakuid","default"=>$searchkakakuid])?>
		<?=$this->Form->hidden("searchunchintorakuid",["id"=>"searchunchintorakuid","default"=>$searchunchintorakuid])?>
		<?=$this->Form->hidden("searchtantoshaid",["id"=>"searchtantoshaid","default"=>$searchtantoshaid])?>
		<?=$this->Form->hidden("searchnyukouid",["id"=>"searchnyukouid","default"=>$searchnyukouid])?>
		<?=$this->Form->hidden("searchshukouid",["id"=>"searchshukouid","default"=>$searchshukouid])?>		
		<?= $this->Form->submit('商品登録',['class'=>'torokubtn'])?>
	    <?= $this->Form->end()?>
		
		<?=$this->Form->create(null,['type'=>'post',
										'url'=>['controller'=>'Butsuryucenters',
										'action'=>'edit']])?>
		<?=$this->Form->hidden("selectNo",["id"=>"selectNo"])?>
		<?=$this->Form->hidden("searchcompanyid",["id"=>"searchcompanyid","default"=>$searchcompanyid])?>
		<?=$this->Form->hidden("searchcompanytelid",["id"=>"searchcompanytelid","default"=>$searchcompanytelid])?>
		<?=$this->Form->hidden("searchcompanyaddressid",["id"=>"searchcompanyaddressid","default"=>$searchcompanyaddressid])?>
		<?=$this->Form->hidden("searchtenpoid",["id"=>"searchtenpoid","default"=>$searchtenpoid])?>
		<?=$this->Form->hidden("searchtenpoaddressid",["id"=>"searchtenpoaddressid","default"=>$searchtenpoaddressid])?>
		<?=$this->Form->hidden("searchtenpotelid",["id"=>"searchtenpotelid","default"=>$searchtenpotelid])?>	
		<?=$this->Form->hidden("searchshohinmeiid",["id"=>"searchshohinmeiid","default"=>$searchshohinmeiid])?>
		<?=$this->Form->hidden("searchshuruiid",["id"=>"searchshuruiid","default"=>$searchshuruiid])?>
		<?=$this->Form->hidden("searchkakakuid",["id"=>"searchkakakuid","default"=>$searchkakakuid])?>
		<?=$this->Form->hidden("searchunchintorakuid",["id"=>"searchunchintorakuid","default"=>$searchunchintorakuid])?>
		<?=$this->Form->hidden("searchtantoshaid",["id"=>"searchtantoshaid","default"=>$searchtantoshaid])?>
		<?=$this->Form->hidden("searchnyukouid",["id"=>"searchnyukouid","default"=>$searchnyukouid])?>
		<?=$this->Form->hidden("searchshukouid",["id"=>"searchshukouid","default"=>$searchshukouid])?>		
		<?=$this->Form->submit("詳細表示",["class"=>"shousaibtn",
										"onclick"=>"return check()",])?>
		<?=$this->Form->end()?>

		<?=$this->Form->create(null,['type'=>'post',"id"=>"download5",
										'url'=>['controller'=>'Butsuryucenters','action'=>'downloadtxt']])?>
		<?=$this->Form->submit("DownLoad",["class"=>"downloadbtn","id"=>"dlfile"])?>
		<?=$this->Form->end() ?>
		
		<?=$this->Form->create(null,['type'=>'post',"id"=>"download6",
										'url'=>['controller'=>'Butsuryucenters',
										'action'=>'download']])?>

		<?php $t=0;?>
		<?php  $excel_flg =0;?>
		<?php foreach ($butsuryucenters as $butsuryucenter): ?>
		<?php $t +=1;?>
		<?php if($t==1){$excel_flg=1;}?>
		<?=$this->Form->hidden("Excel.{$t}",['value'=>$butsuryucenter->id]); ?>
		<?php endforeach; ?>
		<?php if($excel_flg ==1 ){
			echo $this->Form->submit("出力",["class" => "downloadbtn1"]) ;
		}else{
			echo  $this->Form->submit("出力",["class" => "downloadbtn1",
											"onclick"=>"return checkjouhou();"
			]) ;
		}?>
		<?=$this->Form->end() ?>
		
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
				<td class="companytel"><?=h($butsuryucenter->companytel)?></td>
				<td class="companyaddress"><?=h($butsuryucenter->companyaddress)?></td>
				<td class="tenponame"><?=h($butsuryucenter->tenponame)?></td>
				<td class="tenpotel"><?=h($butsuryucenter->tenpotel)?></td>
				<td class="tenpoaddress"><?=h($butsuryucenter->tenpoaddress)?></td>
				<td class="shohinmei"><?=h($butsuryucenter->shohinmei)?></td>
				<td class="shurui"><?=h($butsuryucenter->shurui)?></td>
				<td class="kakaku"><?=number_format(h($butsuryucenter->kakaku))?></td>
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