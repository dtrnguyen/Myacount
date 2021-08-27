<!DOCTYPE Html>
<html>
<head>
	<title>Henshin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?=$this->Html->css(['userhenshins'])?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/Myacount/webroot/js/userhenshin.js"></script>

	<style>
		body{
    background-color:lightblue;
}
h1{
    text-align:center;
    color:Blue;
}
hr{
	width: 70%;
}
.koshinmsg{
    text-align: center;
    color: red;
    font-size: 35px;
}
.container{
    width:1200px;
    margin:0 auto;
    margin-bottom: 50px;
}
.container-left{
    width:430px;
    float:left;
    margin-left: 250px;
}
.container-right{
    width:520px;
    float:left;
}

.koshinbtn{
    width:110px;
    height:45px;
    border-radius:10px;
    margin-left:10px;
    background-color:deepskyblue;
    cursor:pointer;
}
.backbtn{
    position: absolute;
    width:110px;
    height:45px;
    border-radius:10px;
    background-color:deepskyblue;
    cursor:pointer;
    margin-top: -45px;
    margin-left:155px;
}  
.containerbtn{
    position: absolute;
    margin-top: 150px;
    margin-left: 250px;
}
.input-class{
    width: 250px;
    height: 35px;
    border-radius: 6px;
    margin:10px;
}
label{
    background-color: darkturquoise;
    display: block;
    width: 255px;
    margin-bottom:-10px;
    margin-left: 10px;
    border-radius: 6px;
}
table{
    display: none;
}
	</style>
</head>
<body>
	<h1>ユーザー情報</h1>
	<?php echo $koshinmsg;?>
	<hr>
    <div class="container">
        <div class="container-left">
            <?=$this->Form->create(null,["type"=>"post",
                                        "url"=>["controller"=>"Users","action"=>"edit"]
            ])?>
            <?=$this->Form->hidden("id",["id"=>"jouhoid"])?>
            <?=$this->Form->control('userID',['type'=>'text',
                                                'label'=>'ユーザーID',
                                                'id'=>'userID',
                                                'class'=>'input-class'
            ])?>
            <?=$this->Form->control('username',['type'=>'text',
                                            'label'=>'ユーザー名',
                                            'id'=>'username',
                                            'class'=>'input-class'
            ])?>
           
        </div>
        <div class="container-right">
            <?=$this->Form->control('password',['type'=>'password',
                                                'label'=>'パスワード',
                                                'id'=>'password',
                                                'class'=>'input-class'
            ])?>
        </div>
		<div class="containerbtn">
			<?=$this->Form->submit("更新",["class"=>"koshinbtn"])?>
			<?=$this->Form->end()?>

			<?= $this->Form->create(null,['type'=>'get','action'=>'/Myacount/Users'])?>
			<?= $this->Form->button('戻る',['class'=>'backbtn'])?>
			<?= $this->Form->end()?>
		</div>
	</div>
		<div class="yuzajouho">
			<table>
				<tr>
					<th class="userID">UserID</th>
                    <th class="username">Username</th>
                    <th class="password">Password</th>
				</tr>
				<?php foreach($users as $user):?>
				<tr>
					<td class="userID"><?=h($user->userID)?></td>
                    <td class="username"><?=h($user->username)?></td>
                    <td class="password"><?=h($user->password)?></td>
				</tr>
				<?php endforeach ;?>
			</table> 
		</div>
	
</body>
</html>