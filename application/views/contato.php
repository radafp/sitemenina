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
                <div class="col-xs-12 col-md-6">

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
                                <select name="setor" class="form-control" id="email" required data-validation-required-message="Por favor, selecione o setor para o qual deseja enviar a mensagem.">
                                    <option value="comercial">Comercial</option>
                                    <option value="jornalismo">Jornalismo</option>
                                </select>
                                <!-- <input type="email" class="form-control" id="email" required data-validation-required-message="Por favor, selecione o setor para o qual deseja enviar a mensagem."> -->
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Mensagem:</label>
                                <textarea rows="7" cols="100" class="form-control" id="mensagem" required data-validation-required-message="Por favor, digite sua mensagem." maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary" id="enviar">Enviar</button>
                    </form>

                </div>

            </div> <!-- contLeft -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 