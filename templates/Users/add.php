<!DOCTYPE Html>
<html>
<head>
    <title>usertoroku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=$this->Html->css(['usertorokus'])?>

    <style>
        body{
    background-color: darkseagreen;
}
h1{
    text-align: center;
    color:Cyan;
}
hr{
	width: 70%;
}
.torokumsg{
    color: red;
    text-align: center;
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
.containerbtn{
    position: absolute;
    margin-top: 150px;
    margin-left: 240px;
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
.torokubtn{
    width:110px;
    height:45px;
    border-radius:10px;
    margin-left:20px;
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
    margin-left:165px;
}  
    </style>
</head>
<body>
    <h1>ユーザー登録</h1><?php echo $torokumsg ?>
    <hr>
    <div class="container">
        <div class="container-left">
            <?=$this->Form->create(null,['type'=>'post',
                                            'url'=>['controller'=>'users','action'=>'add']
            ])?>
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
            <?=$this->Form->submit('登録',['class'=>'torokubtn'])?>
            <?=$this->Form->end()?>
            <?=$this->Form->create(null,['type'=>'get',
                                        'url'=>['controller'=>'users','action'=>'index']
            ])?>
            <?=$this->Form->submit("戻る",['class'=>'backbtn'])?>
            <?=$this->Form->end()?>
        </div>
    </div>
</body>
</html>