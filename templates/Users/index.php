<!DOCTYPE Html>
<html>
<head>
    <title>Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=$this->Html->css(['userichirans'])?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/Myacount/webroot/js/userichiran.js"></script>

    <style>
        body{
    background-color: darkseagreen;
}
h1{
    text-align: center;
    color:Cyan;
}
hr{
    width:70%;
}
.container{
    width: 1200px;
    margin:0 auto;
    margin-bottom: 50px;
    
}
.container-left{
    width:400px;
    float:left;
    margin-left:250px;
}
.container-right{
    width:535px;
    float:left;
    margin-left:15px;
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
    width: 254px;
    margin-bottom:-10px;
    margin-left: 10px;
    border-radius: 6px;
}
.kensakubtn{
    width:110px;
    height:45px;
    border-radius:10px;
    background-color:deepskyblue;
    cursor:pointer;
    float:left; 
}
.torokubtn{
    width:110px;
    height:45px;
    border-radius:10px;
    float:left;
    margin-left:305px;
    background-color:deepskyblue;
    cursor:pointer;
}
.jouhoubtn{
    width:110px;
    height:45px;
    border-radius:10px;
    float:left;
    margin-left:38px;
    background-color:deepskyblue;
    cursor:pointer;
}
.containerbtn{
    margin-left:210px;
    padding:50px;  
}
.id,.password{
    display: none;
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
    </style>
</head>

<body>
    <h1>ユーザー管理</h1>
    <hr>
    <div class="container">
        <div class="container-left">
            <?=$this->Form->create(null,['type'=>'post',
                                        'url'=>['controller'=>'Users','action'=>'index']
            ]);?>
            <?=$this->Form->control('userID',['type'=>'text',
                                                "label"=>"ユーザーID",
                                                "class"=>"input-class",
            ])?>
        </div>
        <div class="container-right">
            <?=$this->Form->control('username',['type'=>'text',
                                                "label"=>"ユーザ名",
                                                "class"=>"input-class",
            ])?>
         </div>
         <div class="containerbtn">
            <?=$this->Form->submit('検索',['class'=>"kensakubtn"])?>
            <?=$this->Form->end()?>

            <?=$this->Form->create(null,['type'=>'post',
                                        'url'=>['controller'=>'Users','action'=>'add']
            ])?>
            <?=$this->Form->submit('ユーザー登録',['class'=>"torokubtn"])?>
            <?=$this->Form->end()?>

            <?=$this->Form->create(null,['type'=>'post',
                                        'url'=>['controller'=>'Users','action'=>'edit']
            ])?>
            <?=$this->Form->hidden("id",["id"=>"jouhoid"])?>
            <?=$this->Form->submit("ユーザー情報",["class"=>"jouhoubtn","onclick"=>"return check()"])?>
            <?=$this->Form->end()?>

        </div>
    </div>
    <div class="usersichiran">
        <table>
            <thead>
                <tr>
                    <th class="id">Id</th>
                    <th class="userID">UserID</th>
                    <th class="username">Username</th>
                    <th class="password">Password</th>
                    <th class="lastchangeuser">Lastchangeuser</th>
                    <th class="lastchangeupdate">Lastchangeupdate</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="id"><?= $this->Number->format($user->id) ?></td>
                    <td class="userID"><?= h($user->userID) ?></td>
                    <td class="username"><?= h($user->username) ?></td>
                    <td class="password"><?= h($user->password) ?></td>
                    <td class="lastchangeuser"><?= h($user->lastchangeuser) ?></td>
                    <td class="lastchangeupdate"><?= h($user->lastchangeupdate) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>