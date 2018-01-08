<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script type="text/javascript">
     $(document).ready(function(){


        var content = $('#content');
        $('.link_descricao').click(function( e ){
            e.preventDefault();

            var href = $( this ).attr('href');
            $.ajax({
                url: href,
                success: function( response ){
                    //forçando o parser
                    var data = $( '<div>'+response+'</div>' ).find('#content').html();

                    //apenas atrasando a troca, para mostrarmos o loading
                    window.setTimeout( function(){
                        content.fadeOut('fast', function(){
                            content.html( data ).fadeIn();
                        });
                    },100);
                }
            });
        });
    });
</script>
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

                    <form name="from_contato" id="contactForm" action="<?php echo $action ?>">
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Nome:</label>
                                <input type="text" class="form-control" id="name" required data-validation-required-message="Por favor, digite seu nome.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>E-mail:</label>
                                <input type="email" class="form-control" id="email" required data-validation-required-message="Por favor, digite seu e-mail.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Telefone:</label>
                                <input type="tel" class="form-control" id="telefone" required data-validation-required-message="Por favor, digite seu telefone.">
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Setor:</label>
                                <select name="selectRegiao" form="form" id='regiao'>
                                    <option value="/balneario-camboriu" <?=$_SESSION['regiao'] == 'bc' ? 'selected' : '';?> >Balneário Camboriú</option>
                                    <option value="/blumenal" <?=$_SESSION['regiao'] == 'bl' ? 'selected' : '';?> >Blumenau</option>
                                    <option value="/lages" <?=$_SESSION['regiao'] == 'lg' ? 'selected' : '';?> >Lages</option>
                                </select>
                                <input type="email" class="form-control" id="email" required data-validation-required-message="Por favor, selecione o setor para o qual deseja enviar a mensagem.">
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Mensagem:</label>
                                <textarea rows="10" cols="100" class="form-control" id="mensagem" required data-validation-required-message="Por favor, digite sua mensagem." maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary" id="enviar">Enviar</button>
                    </form>
                    <!--
                        <br><br>
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
                            <a class='link_descricao' href="<?php echo $action ?>"><label>&nbsp;</label>
                            <button type="submit" id="enviar">Enviar</button></a>
                        </div>
                        
                    </form>
                    -->

                </div>

            </div> <!-- contLeft -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 