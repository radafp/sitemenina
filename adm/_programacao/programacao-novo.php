<?php
if(isset($modulos[$id][3]['include']) && file_exists($modulos[$id][3]['include']))
{
    $acesso = "programacao-novo";
    require_once $modulos[$id][3]['include'];
}
else
{
    echo "Arquivo não encontrado.";
}
?>