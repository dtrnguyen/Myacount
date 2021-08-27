<!DOCTYPE Html>
<html>
<head>
	<title>inframeindex</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?=$this->Html->css(['iframeindex'])?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/Myacount/webroot/js/iframeindex.js"></script>
</head>
<body>
	<div class="shouhintoroku">
		<?=$this->Form->create(null,['type'=>'post',
									'url'=>['controller'=>'Kokyakuichirans','action'=>'iframeindex']])?>
		<?=$this->Form->control("companyname",["type"=>"text",
											"id"=>"companyname","label"=>"会社名"])?>
		<?=$this->Form->control("tenponame",["type"=>"text",
											"id"=>"tenponame","label"=>"店舗名"])?>
	</div>
		<?=$this->Form->submit("検索",["class"=>"kensakubtn"])?>
		<?=$this->Form->end()?>

		<?=$this->Form->create(null,["onsubmit"=>"return false"])?>
		<?=$this->Form->submit("反映",["id"=>"hanei","class"=>"haneibtn"])?>
		<?=$this->Form->end()?>
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