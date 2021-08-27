<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Html->script('jquery-3.5.1.min');?>
	<?= $this->Html->script('jquery.tablefix_1.0.1');?>
    <?= $this->Html->script('modal');?>
    
    <style>
        body,html{
            height: 100%; /*footerがbootomに存在*/
        }
        body {
            margin: 0;
        }
        p{
            color:floralwhite;
        }

        h5,ul,li{
            margin:0;/*footerがbootmに固定,footerの中にh5がある為*/
        }
        .menu{
            width:100%;
            background-color:midnightblue;
            height: 50px;
            min-width: 2000px;/*広さmin*/
        }
        .menu ul{
            margin: 0px;
            padding: 0px;
        }
        .menu ul li{
            list-style: none;
            float:left; 
        }
        .menu ul li a{
            text-decoration:none;
            display:block;
            height: 50px;
            line-height:50px;
            color:whitesmoke;
            padding: 0px 30px 0px 30px;
            border-right:1px solid mintcream;
        }
        .logout{
            float:right;
        }

        .footer{
            width:100%;
            background-color:midnightblue;
            height: 50px;
            min-width: 2000px;/*広さmin*/
        }
        .footer li{
            list-style: none;
            color:whitesmoke;
            height: 50px;
            line-height:50px;
        }


        /*test css*/

       

        .container {
            /*overflow: hidden;*/
            min-height: 100%; /* full height almost always */
        }


        /*base1 css*/


        .clearfix:before, .clearfix:after{
            content:" ";
            display:table
        }
        .clearfix:after{
            clear:both
        }
  
    </style>
</head>
<body>
    <div class="menu">
        <ul>
            <li>
                <a href="/Myacount/Butsuryucenters">商品一覧</a>
            </li>
            <li>
                <a href="/Myacount/Kokyakuichirans">顧客管理</a>
            </li>
            <li>
                <a href="/Myacount/Users">ユーザー管理</a>
            </li>
        </ul>
        <ul class="logout">
            <li>
                <p> ⊛ ログインID： <?=$this->request->getsession()->read('Auth.User.userID')?>
                    ⊛ ユーザー名： <?=$this->request->getsession()->read('Auth.User.username')?>
                </p>
            </li>
            <li>
                <a href="/Myacount/users/logout">ログアウト</a>
            </li>
        </ul>
    </div>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>

    <div class="footer">
        <ul>
            <li><h5> BTC-version 1.1 </h5> </li>
        </ul>
    </div>
</body>


</html>
