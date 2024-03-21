<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Avaliação</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <?php
        include("conn.php");
    ?>

    <!-- Image and text -->
    <img src="img/312860882_567125738551129_7490135894950538800_n.png" id="imgplayfibra" alt="">

    <div class="container">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default panel-login">
                <div class="panel-heading text-center" id="cortitulo">LOGIN INICIAL</div>
                <div class="panel-body">
                    <form action="autentica.php" method="POST">
                        <!-- input login-->
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                            <input type="text" name="nome_supervisor" placeholder="Digite o nome do usuário" class="form-control">
                        </div>
                        <br>
                        <!-- input senha-->
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                            </span>
                            <input type="password" name="senha" placeholder="Digite sua a senha" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success bt-entrar">ENTRAR</button>
                        </div>
                    </form>
                </div>

                <?php 
                if (isset($_GET['msg'])){  
                    $mensagem_ext = $_GET['msg'] == 'erro_login' ? 'LOGIN INVÁLIDO. <br> Tente novamente!' : 'ACESSO NÃO AUTORIZADO!';
                ?>
                <div class="panel panel-warning text-center">
                    <?php echo $mensagem_ext; ?>
                </div> 
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
