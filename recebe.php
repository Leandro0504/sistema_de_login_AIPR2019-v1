<?php
// Inicializando a sessão
session_start();

// É necessário fazer a conexão com o Banco de Dados
require_once "configDB.php";


function verificar_entrada($entrada)
{
    $saida = trim($entrada); //Remove espaços antes e depois
    $saida = stripslashes($saida); //Remove as barras
    $saida = htmlspecialchars($saida);
    return $saida;
}

if (
    isset($_POST['action']) &&
    $_POST['action'] == 'senha'
) {
    //Apenas para Debug / Teste
    //echo "<strong>Recuperação de Senha</>";
    $emailSenha = verificar_entrada($_POST['emailSenha']);
    $sql = $conecta->prepare("SELECT idUsuario FROM usuario WHERE email = ?");
    $sql->bind_param("s", $emailSenha);
    $sql->execute();
    $resultado = $sql->get_result();
    if ($resultado->num_rows > 0) {
        //Existe o usuário no Banco de Dados
        //echo "<p class=\"text-success\">E-mail encontrado</p>";
        $frase = "Acredite no seu potencial!";
        $frase_secreta = str_shuffle($frase);
        $token = substr($frase_secreta, 0, 10);
        //echo "<p>$token</p>";
        $sql = $conecta->prepare("UPDATE usuario SET token = ?, tempo_de_vida = DATE_ADD(NOW(), INTERVAL 1 MINUTE) WHERE email = ?");
        $sql->bind_param("ss", $token, $emailSenha);
        $sql->execute();
        //Criação do Link para gerar nova senha
        $link = "<a href=\"gerar_senha.php?token=$token\">Clique aqui para gerar uma nova senha</a>";
        //Este link deve ser enviado por e-mail
        echo $link;
    } else {
        echo '<p class="text-danger">E-mail não encontrado</p>';
    }
} else if (
    isset($_POST['action']) &&
    $_POST['action'] == 'login'
) {
    //Verificação e Login do usuário
    $nomeUsuario = verificar_entrada($_POST['nomeUsuario']);
    $senhaUsuario = verificar_entrada($_POST['senhaUsuario']);
    $senha = sha1($senhaUsuario);
    //Para teste
    //echo "Usuário: $nomeUsuario <br> senha: $senha";
    $sql = $conecta->prepare("SELECT * FROM usuario WHERE nomeUsuario = ? AND senha = ?");
    $sql->bind_param("ss", $nomeUsuario, $senha);
    $sql->execute();

    $busca = $sql->fetch();
    if ($busca != null) {
        //Colocando o nome do usuário na Sessão
        $_SESSION['nomeUsuario'] = $nomeUsuario;
        echo "ok!";
        if (!empty($_POST['lembrar'])) {
            //Se não estiver vazio
            //Armazenar Login e Senha no Cookie
            setcookie("nomeUsuario", $nomeUsuario, time() + (30 * 24 * 60 * 60));
            setcookie("senhaUsario", $senhaUsuario, time() + (30 * 24 * 60 * 60)); //30 dias em segundos
        } else {
            //Se estiver vazio
            setcookie("nomeUsuario", "");
            setcookie("senhaUsuario", "");
        }
    } else {
        echo "usuário e senha não conferem!";
    }
} else if (
    isset($_POST['action']) &&
    $_POST['action'] == 'cadastro'
) {

    //Pegar os campos do formulário
    $nomeCompleto = verificar_entrada($_POST['nomeCompleto']);
    $nomeUsuario = verificar_entrada($_POST['nomeUsuário']);
    $emailUsuario = verificar_entrada($_POST['emailUsuário']);
    $senhaUsuario = verificar_entrada($_POST['senhaUsuário']);
    $senhaConfirma = verificar_entrada($_POST['senhaConfirma']);
    $urlAvatar = verificar_entrada($_POST['urlAvatar']);
    //$concordar = $_POST['concordar'];
    $dataCriacao = date("Y-m-d H:i:s");

    //Hash de senha / Codificação de senha em 40 caracteres
    $senha = sha1($senhaUsuario);
    $senhaC = sha1($senhaConfirma);


    if ($senha != $senhaC) {
        echo "<h1>As senhas não conferem</h1>";
        exit();
    } else {
        //echo "<h5> senha codificada: $senha</h5>";
        //Verificar se o usuário já existe no banco de dados
        $sql = $conecta->prepare("SELECT nomeUsuario, email FROM usuario WHERE nomeUsuario = ? OR email = ?");
        //Substitui cada ? por uma string abaixo
        $sql->bind_param("ss", $nomeUsuario, $emailUsuario);
        $sql->execute();
        $resultado = $sql->get_result();
        $linha = $resultado->fetch_array(MYSQLI_ASSOC);
        if ($linha['nomeUsuario'] == $nomeUsuario) {
            echo "<p>Nome de usuário indisponível, tente outro</p>";
        } elseif ($linha['email'] == $emailUsuario) {
            echo "<p>E-mail já em uso, tente outro</p>";
        } else {
            $sql = $conecta->prepare("INSERT into usuario (nome, nomeUsuario, email, senha, dataCriacao, avatar_url) values(?, ?, ?, ?, ?, ?)");
            $sql->bind_param("ssssss", $nomeCompleto, $nomeUsuario, $emailUsuario, $senha, $dataCriacao, $urlAvatar);
            if ($sql->execute()) {
                echo "<p>Registrado com sucesso</p>";
            } else {
                echo "<p>Algo deu errado. Tente outra vez.</p>";
            }
        }
    }
} else {
    echo "<h1 style='color:red'>Esta página não pode 
    ser acessada diretamente</h1>";
}
