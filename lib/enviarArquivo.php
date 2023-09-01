<?php
function enviarArquivo($erro, $size, $name, $tmp_name)
{
    if ($erro) {
        echo '
        <div class="errordiv">
            <p>Algo está errado, verifique se os termos foram inseridos corretamente.</p>
            <div class="sideleft"></div>
        </div>';
    }
    if ($size > 2097152) {
        echo '
        <div class="errordiv">
            <p>Algo está errado, verifique se os termos foram inseridos corretamente.</p>
            <div class="sideleft"></div>
        </div>';
    }
    $pasta = "./upload/";
    $nome_do_arquivo = $name;
    $novo_nome_do_arquivo = uniqid();
    $extensao = strtolower(pathinfo($nome_do_arquivo, PATHINFO_EXTENSION));
    if ($extensao != "jpg" && $extensao != 'png' && $extensao != 'gif') {
        die('
        <div class="errordiv">
            <p>Algo está errado, verifique se os termos foram inseridos corretamente.</p>
            <div class="sideleft"></div>
        </div>');
    }

    $path = $pasta . $novo_nome_do_arquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($tmp_name, $path);

    if($deu_certo){
        return $path;
    }else{
        return false;
    }

}