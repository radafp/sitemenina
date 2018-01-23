<?php
if(isset($modulos[$id][3]['include']) && file_exists($modulos[$id][3]['include']))
{
    $acesso = "equipe";
    require_once $modulos[$id][3]['include'];
}
else
{
    echo "Arquivo não encontrado.";
}
?>