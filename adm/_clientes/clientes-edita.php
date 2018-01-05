<?php
if(!verifica_permissao($cod_user, $nivel, 'clientes'))
{
	echo "<script>
	       alert('Você não tem permissão para acessar esta página!\\nEntre em contato com o administrador.')
	       document.location.replace('".ssl().ADMIN_URL."/principal.php');";
	echo " </script>";
	die();
}

require_once ADMIN_INC_PATH."bread.php";
require_once ADMIN_INC_PATH."topoModulo.php";
require_once ADMIN_PATH."func/fotos.php";
require_once ADMIN_PATH."func/imprimeTinymce.php";

$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

if($submit != '')
{
    $data = date('Y-m-d');

    $tipoPessoa = isset($_POST['tipoPessoa']) ? $_POST['tipoPessoa'] : '';
    
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
    $inscricaoEstadual = isset($_POST['inscricaoEstadual']) ? $_POST['inscricaoEstadual'] : '';
    
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $rg = isset($_POST['rg']) ? $_POST['rg'] : '';
    
    $razaoSocial = isset($_POST['razaoSocial']) ? $_POST['razaoSocial'] : '';
    $ramoAtividade = isset($_POST['ramoAtividade']) ? $_POST['ramoAtividade'] : '';
    
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '';
    $dataNascimento = isset($_POST['dataNascimento']) ? $_POST['dataNascimento'] : '';
    $dataNascimento = dataEn($dataNascimento);
    $profissao = isset($_POST['profissao']) ? $_POST['profissao'] : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
    $whatsapp = isset($_POST['whatsapp']) ? $_POST['whatsapp'] : '';
    $telefoneComercial = isset($_POST['telefoneComercial']) ? $_POST['telefoneComercial'] : '';
    $telefoneComercialRamal = isset($_POST['telefoneComercialRamal']) ? $_POST['telefoneComercialRamal'] : '';
    $fax = isset($_POST['fax']) ? $_POST['fax'] : '';
    $faxRamal = isset($_POST['faxRamal']) ? $_POST['faxRamal'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $obs = isset($_POST['obs']) ? $_POST['obs'] : '';
    $site = isset($_POST['site']) ? $_POST['site'] : '';
    $situacao = isset($_POST['situacao']) ? 1 : 0;
    
    $msg = array();
    $erro = 0;
    
    if($erro == 0)
    {
        if($subid == 2) //insert
        {
        	$q = mysql_query("INSERT INTO clientes 
                            (dataCadastro, tipoPessoa, cnpj, inscricaoEstadual, cpf, rg, razaoSocial, ramoAtividade, nome, sobrenome, dataNascimento, profissao, sexo, email, telefone, celular, whatsapp,
                            telefoneComercial, telefoneComercialRamal, fax, faxRamal,  senha, obs, site, situacao)
                            VALUES
                             ('$data', '$tipoPessoa', '$cnpj', '$inscricaoEstadual', '$cpf', '$rg', '$razaoSocial', '$ramoAtividade', '$nome', '$sobrenome', '$dataNascimento', '$profissao', '$sexo', '$email', 
                            '$telefone', '$celular', '$whatsapp', '$telefoneComercial', '$telefoneComercialRamal', '$fax', '$faxRamal', '$senha', '$obs', '$site', '$situacao')");
        	
            if($q)
            {
                echo "<script>
        		          alert('Cadastro efetuado com sucesso.');
        		          document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
        		      </script>";
                die();
        	}	
        	else
        	{
        		echo "<script>
        		          alert('Erro ao cadastrar.');
                      </script>"; 
        	} 
        }
        elseif($subid == 3) //update
        {

            $q = mysql_query("UPDATE clientes SET 
                            dataAlteracao = '{$data}',
                            tipoPessoa = '{$tipoPessoa}',
                            cnpj = '{$cnpj}', 
                            inscricaoEstadual = '{$inscricaoEstadual}', 
                            cpf = '{$cpf}',
                            rg = '{$rg}',
                            razaoSocial = '{$razaoSocial}', 
                            ramoAtividade = '{$ramoAtividade}',
                            nome = '{$nome}',
                            sobrenome = '{$sobrenome}',
                            dataNascimento = '{$dataNascimento}',  
                            profissao = '{$profissao}',
                            sexo = '{$sexo}',  
                            email = '{$email}', 
                            telefone = '{$telefone}', 
                            celular = '{$celular}',
                            whatsapp = '{$whatsapp}',
                            telefoneComercial = '{$telefoneComercial}', 
                            telefoneComercialRamal = '{$telefoneComercialRamal}', 
                            fax = '{$fax}', 
                            faxRamal = '{$faxRamal}', 
                            senha = '{$senha}', 
                            obs = '{$obs}', 
                            site = '{$site}', 
                            situacao = '{$situacao}'
                            WHERE cod = {$cod}"); 

            //echo mysql_error();
                                        
            if($q)
        	{
        	    
                echo "<script>
                          alert('Cadastro atualizado com sucesso.');
                          document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
                      </script>";
                die();
        	}	
        	else
        	{
        		echo "<script>
        		          alert('Erro ao atualizar cadastro.');
                      </script>"; 
        	}   
        }
    }
    else
    {
        echo "<script>
		          alert('".implode("\\n",$msg)."');
              </script>"; 
    }
}
else
{
    if($subid == 3)
    {
        $q = mysql_query("SELECT * FROM clientes WHERE cod = $cod LIMIT 1",$conexao);
        $n = mysql_num_rows($q);

        if($n > 0)
        {
            $tp = mysql_fetch_assoc($q);
            
            $tipoPessoa = $tp['tipoPessoa'];
    
            $cnpj = $tp['cnpj'];
            $inscricaoEstadual = $tp['inscricaoEstadual'];
            
            $cpf = $tp['cpf'];
            $rg = $tp['rg'];
            
            $razaoSocial = $tp['razaoSocial'];
            $ramoAtividade = $tp['ramoAtividade'];
            
            $nome = $tp['nome'];
            $sobrenome = $tp['sobrenome'];
            $dataNascimento = dataBr($tp['dataNascimento']);
            $profissao = $tp['profissao'];
            $sexo = $tp['sexo'];
            $email = $tp['email'];
            $telefone = $tp['telefone'];
            $celular = $tp['celular'];
            $whatsapp = $tp['whatsapp'];
            $telefoneComercial = $tp['telefoneComercial'];
            $telefoneComercialRamal = $tp['telefoneComercialRamal'];
            $fax = $tp['fax'];
            $faxRamal = $tp['faxRamal'];
            $senha = $tp['senha'];
            $obs = $tp['obs'];
            $site = $tp['site'];
            $situacao = $tp['situacao'];
        }
        else
        {
            echo "<script>
    		          alert('Registro não encontrado.');
    		          document.location.replace('http://".ADMIN_URL."/principal.php?id=$id&subid=1')
    		      </script>";
            die();
        }
    }
    else
    {
        $tipoPessoa = "";
    
        $cnpj = '';
        $inscricaoEstadual = '';
        
        $cpf = '';
        $rg = '';
        
        $razaoSocial = '';
        $ramoAtividade = '';
        
        $nome = '';
        $sobrenome = '';
        $dataNascimento = '';
        $profissao = '';
        $sexo = '';
        $email = '';
        $telefone = '';
        $celular = '';
        $whatsapp = '';
        $telefoneComercial = '';
        $telefoneComercialRamal = '';
        $fax = '';
        $faxRamal = '';
        $senha = '';
        $obs = '';
        $site = '';
        $situacao = 0;
    }
}

?>
<form name="cadastro" id="cadastro" method="post" action="" enctype="multipart/form-data">
    <div class="divTableForm clear">
        
        <div class="divTr">
            <div class="divTd">
                <label>Tipo Pessoa:</label>
            </div>
            <div class="divTd">
                F&iacute;sica &nbsp;
                <input type="radio" name="tipoPessoa" value="f" id="tipoPessoa" title="Tipo de Pessoa" <?=$tipoPessoa == 'f'|| $tipoPessoa == '' ? "checked='true'" : ''; ?> />
                &nbsp;&nbsp;
                Jur&iacute;dica &nbsp;
                <input type="radio" name="tipoPessoa" value="j" id="tipoPessoa" title="Tipo de Pessoa" <?=$tipoPessoa == 'j' ? "checked='true'" : ''; ?> />
            </div>
        </div>

        <!--
        ##Cadastro Pessoa Fisica
        -->
        <div class="divTr" id="divPessoaFisica1" style="display: <?=$tipoPessoa == 'f' ? 'show': 'none';?>;">
            <div class="divTd">
                <label>CPF:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="cpf" id="cpf" value="<?=$cpf;?>" title="CPF"/>
            </div>
            <div class="divTd">
                <label>RG:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="rg" id="rg" value="<?=$rg;?>" title="RG"/>
            </div>
            <div class="divTd">
                <label>Data de Nascimento:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="dataNascimento" id="dataNascimento" value="<?=$dataNascimento;?>" title="Data de Nascimento"/>
            </div>
        </div>    

        <div class="divTr" id="divPessoaFisica2" style="display: <?=$tipoPessoa == 'f' ? 'show': 'none';?>;">
            <div class="divTd">
                <label>Nome:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="nome" id="nome" value="<?=$nome;?>" title="Nome"/>
            </div>
            <div class="divTd">
                <label>Sobrenome:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="sobrenome" id="sobrenome" value="<?=$sobrenome;?>" title="Sobrenome"/>
            </div>
            <div class="divTd">
                <label>Sexo:</label>
            </div>
            <div class="divTd">
                <select class="campoP" id="sexo" name="sexo" title="Sexo">
                    <option <?=$sexo == "" ? "selected='true'" : '' ;?> value="F">Selecione</option>
                    <option <?=$sexo == "F" ? "selected='true'" : '' ;?> value="F">F</option>
                    <option <?=$sexo == "M" ? "selected='true'" : '' ;?> value="M">M</option>
                </select>
            </div>
        </div>

        <!--
        ##Cadastro Pessoa Jurídica
        -->
        <div class="divTr" id="divPessoaJuridica" style="display: <?=$tipoPessoa == 'j' ? 'show': 'none';?>;">
            <div class="divTd">
                <label>CNPJ:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="cnpj" id="cnpj" value="<?=$cnpj;?>" title="CNPJ"/>
            </div>
            <div class="divTd">
                <label>Inscrição Estadual:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="inscricaoEstadual" id="inscricaoEstadual" value="<?=$inscricaoEstadual;?>" title="Inscrição Estadual"/>
            </div>
        </div>
        <div class="divTr" id="divPessoaJuridica" style="display: <?=$tipoPessoa == 'j' ? 'show': 'none';?>;">
            <div class="divTd">
                <label>Razão Social:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="razaoSocial" id="razaoSocial" value="<?=$razaoSocial;?>" title="Razão Social"/>
            </div>
            <div class="divTd">
                <label>Ramo de Atividade:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="ramoAtividade" id="ramoAtividade" value="<?=$ramoAtividade;?>" title="Ramo de Atividade"/>
            </div>
        </div>
    </div>
    <div class="divTableForm clear">

        <div class="divTr">
            <div class="divTd">
                <label>E-mail:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoM" name="email" id="email" value="<?=$email;?>" title="E-mail"/>
            </div>
        </div>
    </div>

    <div class="divTableForm clear">
        <div class="divTr">
            <div class="divTd">
                <label>WhatsApp:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="whatsapp" id="whatsapp" value="<?=$whatsapp;?>" title="WhatsApp"/>
            </div>
            <div class="divTd">
                <label>Celular:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="celular" id="celular" value="<?=$celular;?>" title="Celular"/>
            </div>
        </div>
        <div class="divTr">
            <div class="divTd">
                <label>Telefone:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="telefone" id="telefone" value="<?=$telefone;?>" title="Telefone"/>
            </div>
            <div class="divTd">
                <label>Telefone comercial:</label>
            </div>
            <div class="divTd">
                <input type="text" class="campoP" name="telefoneComercial" id="telefoneComercial" value="<?=$telefoneComercial;?>" title="Telefone Comercial"/>
            </div>
        </div>
        
    </div>

    <div class="divTr">
        <div class="divTd">&nbsp;</div>
        <div class="divTd">
            <input type="submit" value="Salvar" name="submit" class="salvar" />
        </div>
    </div>
</form>
<script type="text/javascript">
    
    function changeTipoPessoa()
    {
        //$('#cpfCnpj').unmask();
        if($(".tipoPessoa:checked").val() == "f")
        {
            //objValidador . remover('#ramoAtividade');
            //objValidador . remover('#inscricaoEstadual');
            //objValidador . remover('#nomeContato');
            
            //objValidador . adicionar('#sexo');
            //objValidador . adicionar('#dataNascimento');
            //objValidador . adicionar('#profissao');
            
            //$('#cpfCnpj').removeAttr('disabled');


            $("#divPessoaJuridica").hide();

            $("#divPessoaFisica1").show();
            $("#divPessoaFisica2").show();
        }
        else
        {
            //objValidador . remover('#sexo');
            //objValidador . remover('#dataNascimento');
            //objValidador . remover('#profissao');
            
            //objValidador . adicionar('#ramoAtividade');
            //objValidador . adicionar('#inscricaoEstadual');
            //objValidador . adicionar('#nomeContato');
            
            //$('#cpfCnpj').removeAttr('disabled');
            //$('#cpfCnpj').mask('99.999.999/9999-99');

            $("#divPessoaFisica1").hide();
            $("#divPessoaFisica2").hide();

            $("#divPessoaJuridica").show();   
        }
    }
    
    $(document).ready(function()
    {
        
        if($("#tipoPessoa:checked").val() == "f")
        {
           $("#divPessoaFisica").show();
        }
        else
        {
           $("#divPessoaJuridica").show();
        }

        $('#cpf').mask('999.999.999-99'); 
        $('#dataNascimento').mask("99/99/9999");
        
        $("#whatsapp")
        .keyup(function()
        {
            tel = $(this).val();
            v = tel;
            v += '';
            v = v . replace(/\D/g, ''); //Remove tudo o que não é dígito
            v = v . replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v . replace(/(\d{1})?(\d{4})(\d{4})$/, '$1$2-$3');
            return this.value = v;
        })
        .keypress(function(e)
        {
            return validaTecla(e, 'inteiro');
        })

        $("#celular")
        .keyup(function()
        {
            tel = $(this).val();
            v = tel;
            v += '';
            v = v . replace(/\D/g, ''); //Remove tudo o que não é dígito
            v = v . replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v . replace(/(\d{1})?(\d{4})(\d{4})$/, '$1$2-$3');
            return this.value = v;
        })
        .keypress(function(e)
        {
            return validaTecla(e, 'inteiro');
        })

        $("#telefone")
        .keyup(function()
        {
            tel = $(this).val();
            v = tel;
            v += '';
            v = v . replace(/\D/g, ''); //Remove tudo o que não é dígito
            v = v . replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v . replace(/(\d{1})?(\d{4})(\d{4})$/, '$1$2-$3');
            return this.value = v;
        })
        .keypress(function(e)
        {
            return validaTecla(e, 'inteiro');
        })
        
        $("#telefoneComercial")
        .keyup(function()
        {
            tel = $(this).val();
            v = tel;
            v += '';
            v = v . replace(/\D/g, ''); //Remove tudo o que não é dígito
            v = v . replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v . replace(/(\d{1})?(\d{4})(\d{4})$/, '$1$2-$3');
            return this.value = v;
        })
        .keypress(function(e)
        {
            return validaTecla(e, 'inteiro');
        })

        $('#cnpj').mask('99.999.999/9999-99');
        
        /*

        $("input#cep").blur(function(){
            atualiza();
        });
        objValidador = new xform('form#cadastro');
        objValidador . adicionar('input#tipoPessoa');
        objValidador . adicionar('input#documento');
        objValidador . adicionar('input#razaoSocialNome');
        objValidador . adicionar('input#email','email');
        objValidador . adicionar('input#telefone','fone5');
        objValidador . adicionar('input#celular','fone5',true);
        
        objValidadorEnd = new xform('form#cadastroEnd');
        objValidadorEnd . adicionar('input#cep','cep');
        objValidadorEnd . adicionar('input#endereco');
        objValidadorEnd . adicionar('input#numero');
        objValidadorEnd . adicionar('input#bairro');
        objValidadorEnd . adicionar('input#cidade');
        objValidadorEnd . adicionar('input#estado');
        objValidador . adicionar('input#situacao');
        */
                        
        $('input#tipoPessoa').change(function()
        {     
            if ($('input#tipoPessoa:checked').val() == 'f')
            {
                $("div#divPessoaJuridica").hide();
                $("div#divPessoaFisica1").show(300);
                $("div#divPessoaFisica2").show(300);
                
                /*
                objValidador . remover('input#ramoAtividade');
                objValidador . remover('input#inscricaoEstadual');
                objValidador . remover('input#nomeContato');
                objValidador . remover('input#telefoneContato');
                objValidador . adicionar('input#sexo');
                objValidador . adicionar('input#dataNascimento',"dataBr");
                objValidador . adicionar('input#profissao');
                $('input#documento').removeAttr('disabled');
                $('input#documento').mask('999.999.999-99');    
                */
            }
            else if ($('input#tipoPessoa:checked').val() == 'j')
            {

                $("div#divPessoaFisica1").hide();
                $("div#divPessoaFisica2").hide();
                $("div#divPessoaJuridica").show(300);
                /*
                objValidador . remover('input#sexo');
                objValidador . remover('input#dataNascimento');
                objValidador . remover('input#profissao');
                objValidador . adicionar('input#ramoAtividade');
                objValidador . adicionar('input#inscricaoEstadual');
                objValidador . adicionar('input#nomeContato');
                objValidador . adicionar('input#telefoneContato');
                $('input#documento').removeAttr('disabled');
                $('input#documento').mask('99.999.999/9999-99');
                */
            }
        });
        
        if ($('input#tipoPessoa:checked').val() == '' || $('input#tipoPessoa:checked').val() == null || $('input#tipoPessoa:checked').val() == undefined)
        {
            $('input#documento').attr('disabled','true');   
        }
        
        
    });




    /*


    $(document).ready(function()
    {
        objValidadorCadastro = new xform('#cadastro',
        {
    	   callbackTrue:function()
           {
    	        _erros = new Array();
                
                $("input[name='fotos[]']").each(function(_k)
                {
                    _file = $(this).val();
                    if(_file != '')
                    {
                        _extFile = _file.split("").reverse().join("").split(".");
                        _extFile = _extFile[0].split("").reverse().join("").toLowerCase();
                        if(_extFile != "png" && _extFile != "jpg" && _extFile != "jpeg")
                        {
                            _erros.push("Formato de arquivo para \"Foto "+(_k+1)+"\" inválido!");
                        }
                    }
                });
                if(_erros.length > 0)
                {
                    _erros.push("\nExtensões permitidas: \".png\", \".jpg\", \".jpeg\"");
                    alert(_erros.join("\n"));
                    return false;
                }
                else
                {
                    return true;
                }
    	   }
        });
        objValidadorCadastro . adicionar('#codCategoria');
        objValidadorCadastro . adicionar('#codSubcategoria');
		objValidadorCadastro . adicionar('#nomePt');
        objValidadorCadastro . adicionar('#nomeEn');
        objValidadorCadastro . adicionar('#descricaoPt');
        objValidadorCadastro . adicionar('#descricaoEn');
        
        
        
        
        
        $('#codCategoria').change(function() //idEstado
        {
            if($(this).val())
            {
                $('#codSubcategoria').hide(); //idCidade
                $('.carregandoSubcategoria').show();
                
                $.ajax(
                {
                    type: "POST",
                    async: false,
                    url: "http://"+ADMIN_URL+"/_artistas/ajax/ajaxSubcategoriasNovoEdita.php", 
                    data:
                    {
                        codCategoria: $(this).val()
                    },
                    dataType: "json",
                    success: function(_json)
                    { 
                        options = new Array();
                        options.push('<option value="">Selecione</option>');	
                        for(_a=0;_a<_json.length;_a++)
                        {
                            options.push("<option value='"+_json[_a].cod+"'>"+_json[_a].subcategoriaPt+"/"+_json[_a].subcategoriaEn+"</option>");
                        }	
                        $('#codSubcategoria').html(options.join("")).show();
                        $('.carregandoSubcategoria').hide();
                    }
                });              
            }
            else
            {
                $('#codSubcategoria').html('<option value="">Selecione</option>');
            }
        });
        
        
        $('input#numFotos').val(Contador . init(1, 1, 10))
        .keyup(function()
        {
            if(window.mg_dalay)
            {
                window.clearTimeout(window.mg_dalay);
            }
    
            window.mg_dalay = window.setTimeout(function(){
                var num = $('input#numFotos').val();
                if (num >= Contador . valorMinimo && num <= Contador . valorMaximo) {
                    Contador . contador = num;
                } else {
                    $('input#numFotos').val(Contador . contador);
                }
                adicionarInputs($('div#groupDivs').get(0), Contador . contador, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
            }, 700);
        });
        adicionarInputs($('div#groupDivs').get(0), Contador . contador, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
    
        $('#maisFotos').click(function()
        {
    		var num = Contador . aumenta();
            $('input#numFotos').val(num);
            adicionarInputs($('div#groupDivs').get(0), num, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
    	});
    
        $('#menosFotos').click(function()
        {
    		var num = Contador . diminui();
            $('input#numFotos').val(num);
            adicionarInputs($('div#groupDivs').get(0), num, 'Foto', 'file', 'fotos[]', 2, 'Legenda', 'text', 'legendas[]');
    	});
    });
    

    */

</script>