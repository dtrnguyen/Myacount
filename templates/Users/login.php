<!DOCTYPE html>
<html>
<head>
    <title>Login acount</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=$this->Html->css(['login'])?>
</head>

<body>
    <h4>ログイン画面</h4><?php echo $errormsg ?>
    <div class="container">
        <div class="container-login">
            <?=$this->Form->create(null,["type"=>"post"])?>
            <?=$this->Form->control("userID",["type"=>"text",
                                                "label"=>"UserName",
                                                "default"=>"",
                                                "class"=>"input-class",
            ])?>
            <?=$this->Form->control("password",["type"=>"password",
                                                "default"=>"",
                                                "class"=>"input-class",
            ])?>
            <?=$this->Form->submit("ログイン",["class"=>"loginbtn"])?>
            <?=$this->Form->end()?>
        </div>
    </div>
</body>
</html>