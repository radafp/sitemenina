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

            <div class="col-xs-12 col-md-6 contLeft">
                <h1 class="tituloPadrao1">
                    <span>Contato</span>
                </h1>
                    
                <div class="blocoContato">

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
            <div class="col-xs-12 col-md-6 contRight">
                <h1 class="tituloPadrao3">
                    <span>Contatos</span>
                </h1> 
                <p>
                    Whatsapp

                    Jornalismo/ utilidade pública: (47) 99174-1005

                    Artístico: (47) 99138-1005

                    Redes Sociais

                    Facebook: Rádio Menina BC (https://www.facebook.com/radiomeninabc)

                    Instagram: @meninafm

                    Comercial

                    comercial@radiomenina.com.br

                    Jornalismo/utilidade pública

                    jornalismo@radiomenina.com.br
                </p>
            </div>
        </div>
        <div class="row mapaContato">
            <div class="col-12 mapa">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2514.3968853302304!2d-48.64014697011674!3d-26.970250310724023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94d8c9f603000029%3A0x373f40990bc2ad4!2sAv.+do+Estado%2C+1555+-+Centro%2C+Balne%C3%A1rio+Cambori%C3%BA+-+SC!5e0!3m2!1spt-BR!2sbr!4v1515414682409" width="95%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div> <!-- container --> 