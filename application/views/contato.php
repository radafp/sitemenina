<div class="container">  
    <div class="blocoConteudo">
        <div class="row">

            <div class="col-12 contLeft">
                <h1 class="tituloPadrao1">
                    <span>Contato</span>
                </h1>
            </div>
        </div>
        <div class="blocoHistoria">
            <div class="row">
                <div class="col-xs-12 col-md-8">

                    <?php if(isset($email_enviado)) { ?>
                        <div id="mensagem_enviada"><?php echo $email_enviado ?></div>
                    <?php } ?>
                    <form id="form_contato" action="<?php echo $action ?>" method="post">
                        <div class="campo">
                            <label for="nome">Nome: </label><input type="text" name="nome" id="nome" />
                        </div>
                        <div class="campo">
                            <label for="email">E-mail: </label><input type="text" name="email" id="email" />
                        </div>
                        <div class="campo">
                            <label for="telefone">Telefone: </label><input type="text" name="telefone" id="telefone" />
                        </div>
                        <div class="campo">
                            <label for="cidade">Cidade: </label><input type="text" name="cidade" id="cidade" />
                        </div>
                        <div class="campo">
                            <label for="estado">Estado: </label><input type="text" name="estado" id="estado" />
                        </div>
                        <div class="campo">
                            <label for="assunto">Assunto: </label><input type="text" name="assunto" id="assunto" />
                        </div>
                        <div class="campo">
                            <label for="mensagem">Mensagem: </label><textarea name="mensagem" id="mensagem" rows="5" cols="40"></textarea>
                        </div>
                        <div class="campo">
                            <label>&nbsp;</label><button type="submit" id="enviar">Enviar</button>
                        </div>
                    </form>

                </div>

            </div> <!-- contLeft -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 