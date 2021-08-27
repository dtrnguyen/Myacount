<!DOCTYPE Html>
<html>
<head>
	<title>Kokyakuichirans</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function check(){
            var hidden = document.getElementById("shousaiid").value;
            if(hidden == ""){
                window.alert("商品名を選んでください");
                return false;
            }else{
                return true;
            }		
        }
        $(document).on('click', 'tr', function(){
            var shousai = $(this).children("td.id").text();
            document.getElementById("shousaiid").value = shousai;
            var toroku = $(this).children("td.id").text();
            document.getElementById("torokuid").value = toroku;
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
                    url:'/Myacount/Kokyakuichirans/findcompany',
                    beforeSend: function(xhr){
                    xhr.setRequestHeader('X-CSRF-Token',csrf);
                    },
                    data:{companyname:$("#companyname").val()}
                    }).done(function(data){
                    console.log(data);
                    $("#tenponame").html(data);
                }).fail(function(){
                    alert('エラーが発生しました。');
                });
            })
        });


    
    </script>
	<style>
        body{
            background-color:lightblue;
        }
        h1{
            text-align:center;
            color:Blue;
        }
        hr{
            width:80%;
        }
        .container{
			width:1200px;
            margin: 0 auto;
		}
		.container .container-left{
			width:600px;
			float:left;
            margin-left:110px;
		}
		.container .container-right{
			width:482px;
            float:left;
            margin-left:8px;
        }
        .containerbtn{
            margin-left: 50px;
            padding:70px;
        }
        .kensakubtn{
            width:90px;
            height:45px;
            border-radius:10px;
            background-color:LightGreen;
            cursor:pointer;
            
            float:left;
        }
        .torokubtn{
            width:90px;
            height:45px;
            border-radius:10px;
            margin-left: 40px;
            background-color:LightGreen;
            float:left;
        }
        .shousaibtn{
            width:90px;
            height:45px;
            border-radius:10px;
            margin-left: 40px;
            background-color:LightGreen;
            cursor:pointer;
            float:left;
        }
        .input-class{
            border-radius:10px;
            display:block;
            width: 350px;
            height: 35px;
            margin:10px;
        }

        label{
            width:350px;
            height: 25px;
            margin-bottom:-10px;
            margin-left: 10px;
            background-color:moccasin;
            border-radius: 6px;
            display: block;
        }
        table{	
            border-collapse: collapse;/*table全体的に線が表示する*/
            text-align: center;
            background-color: beige;
            font-size: 20px;
            margin:0px auto;
        }
        th{
            background-color: rgba(10,120,70,0.3);
            width:150px;
            height: 50px;
            text-align: center;
        }
        td{
            width:150px;
            height: 50px;
            text-align: center;
        }
        th, td {
            border: 1px solid #ddd;/*線の色が少し薄く*/
        }
        table tr th.hidden,table tr td.hidden{
            display:none;
        }
        body table tr.selectrow{
            background-color:lightsteelblue;
            color:#ffffff;
        }
        .id,.shouhinID{
            display: none;
        }
		.komokuichiran{
			width:100%;
			height:40px;
			background-color: rgba(0,0,0,0.4);
		
		}
		.kokyakukanri li a{
			text-decoration:none;
			color:whitesmoke;
			
		}
		.kokyakukanri li{
			margin: auto 0;
			list-style-type:none;

        }
	</style>

</head>
<body>
    <h1>顧客情報</h1>
    <hr>
	<div class="container">
		<div class="container-left">
		<?=$this->Form->create(null,['type'=>'post',
										'url'=>['controller'=>'Kokyakuichirans','action'=>'index']
		])?>
        <?=$this->Form->control("companyname",["type"=>"select",
                                        "options"=>$companynames,
                                        "default"=>$companyname,
                                        "id"=>"companyname",																				
										"label"=>"会社名",										
										"class"=>"input-class left-style",
		])?>
        </div>
        <div class="container-right">
        <?=$this->Form->control("tenponame",["type"=>"select",
                                        "options"=>$tenponames,
                                        "default"=>$tenponame,
                                        "id"=>"tenponame",
										"label"=>"店舗名",
										"class"=>"input-class left-style",
		])?>
		</div> 
    </div>
    <div class="containerbtn">
		<?=$this->Form->submit("検索",["class"=>"kensakubtn"])?>
		<?=$this->Form->end()?>
	
		<?= $this->Form->create(null,['type'=>'post',
                                    'url'=>['controller'=>'Kokyakuichirans','action'=>'add'],])?>
        <?=$this->Form->hidden("torokuid",["id"=>"torokuid"])?>                 
		<?= $this->Form->submit('顧客登録',['class'=>'torokubtn'])?>
	    <?= $this->Form->end()?>
	
	
		<?=$this->Form->create(null,['type'=>'post',
                                        'url'=>['controller'=>'Kokyakuichirans','action'=>'edit']])?>
        <?=$this->Form->hidden("shousaiid",["id"=>"shousaiid"])?>
		<?=$this->Form->submit("顧客詳細",["class"=>"shousaibtn","onclick"=>"return check()",])?>
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
			</tr>
			<?php foreach($kokyakuichirans as $kokyakuichiran):?>
            <tr>
				<td class="id"><?=h($kokyakuichiran->id)?></td>
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
	<br>
</body>
</html>