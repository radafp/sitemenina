<?php
if(isset($modulos[$id][3]['include']) && file_exists($modulos[$id][3]['include']))
{
    $acesso = "artistico";
    require_once $modulos[$id][3]['include'];
}
else
{
    echo "Arquivo não encontrado.";
}
?>