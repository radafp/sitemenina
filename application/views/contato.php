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

                    <form name="from_contato" id="contactForm" method='post' action="<?php echo base_url($_SESSION['city'].'/enviaEmail') ?>">
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Nome:</label>
                                <input name='nome' type="text" class="form-control" id="nome" required data-validation-required-message="Por favor, digite seu nome.">
                                <p class="help-block"></p>
                            </div>  
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>E-mail:</label>
                                <input name="email" type="email" class="form-control" id="email" required data-validation-required-message="Por favor, digite seu email.">
                                <p class="help-block"></p>
                            </div>  
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Telefone:</label>
                                <input name='telefone' type="tel" class="form-control" id="telefone" required data-validation-required-message="Por favor, digite seu telefone.">
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Setor:</label>
                                <select name='setor' class="form-control" id="setor" required data-validation-required-message="Por favor, selecione o setor para o qual deseja enviar a mensagem.">
                                    <option value="comercial">Comercial</option>
                                    <option value="jornalismo">Jornalismo</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Mensagem:</label>
                                <textarea name='mensagem' rows="7" cols="100" class="form-control" id="mensagem" required data-validation-required-message="Por favor, digite sua mensagem." maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary btContato_<?=$_SESSION['regiao'];?>" id="enviar">Enviar</button>
                    </form>

                </div>

            </div> <!-- contLeft -->
            <div class="col-xs-12 col-md-6 contRight">
                <h1 class="tituloPadrao3">
                    <span>Contatos</span>
                </h1> 
                <?php if($_SESSION['regiao'] == 'bc'){ ?>
                    <p>
                        <b>WhatsApp:</b><br>
                        <a class="whatsapp">
                            <i class="fa fa-whatsapp"></i>
                            <span>Jornalismo: (47) 99174.1005</span>
                        </a><br>
                        <a class="whatsapp">
                            <i class="fa fa-whatsapp"></i>
                            <span>Artístico: (47) 99138.1005</span>
                        </a>
                        <br>
                        <a class="whatsapp">
                            <i class="fa fa-whatsapp"></i>
                            <span>Utilidade pública / Bolsa de empregos: (47) 99138.1964</span>
                        </a>  
                    </p>
                    <p>
                        <b>E-mails:</b><br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Comercial: comercial@radiomenina.com.br<br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Jornalismo: jornalismo@radiomenina.com.br<br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Utilidade pública / Bolsa de empregos: recepcao@sistemamenina.com.br
                    </p>
                    <p>
                        <b>Telefone:</b><br>
                        <i class="fa fa-phone" aria-hidden="true"></i> (47) 2103.6000
                    </p>
                    <p>
                        <b>Endereco:</b><br>
                        Av. do Estado nº 1555<br>
                        Camboriú Work Center<br>
                        Pioneiros - Balneário Camboriú/SC<br>
                        CEP: 88331-900 
                    </p>
                <?php
                } if($_SESSION['regiao'] == 'bl'){ ?>

                    <p>
                        <b>WhatsApp:</b><br>
                        <a class="whatsapp">
                            <i class="fa fa-whatsapp"></i>
                            <span>Jornalismo/ utilidade pública: (47) 99128.1070</span>
                        </a><br>
                        <a class="whatsapp">
                            <i class="fa fa-whatsapp"></i>
                            <span>Artístico: (47) 99607.9598</span>
                        </a>
                    </p>
                    <p>
                        <b>E-mails:</b><br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Comercial: opecblu@radiomenina.com.br<br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Jornalismo/utilidade pública: jornalismoblu@radiomenina.com.br
                    </p>
                    <p>
                        <b>Telefone:</b><br>
                        <i class="fa fa-phone" aria-hidden="true"></i> (47) 2102.6500
                    </p>
                    <p>
                        <b>Endereco:</b><br>
                        Rua 7 de Setembro nº 473<br>
                        Centro - Blumenau/SC<br>
                        CEP: 89010-201  
                    </p>
                <?php
                } 
                if($_SESSION['regiao'] == 'lg'){ 
                ?> 
                    <p>
                        <b>WhatsApp:</b><br>
                        <a class="whatsapp">
                            <i class="fa fa-whatsapp"></i>
                            <span>(49) 99824.0492</span>
                        </a>
                    </p>
                    <p>
                        <b>E-mails:</b><br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Comercial: comerciallages@radiomenina.com.br<br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Jornalismo/utilidade pública: jornalismolages@radiomenina.com.br<br>
                        <i class="fa fa-envelope" aria-hidden="true"></i> Artístico:  artisticolages@radiomenina.com.br
                    </p>
                    <p>
                        <b>Telefone:</b><br>
                        <i class="fa fa-phone" aria-hidden="true"></i> (49) 3229.2363
                    </p>
                    <p>
                        <b>Endereco:</b><br>
                        Av. Luís de Camões nº 1370<br>
                        Coral - Lages/SC<br>
                        CEP: 88523-000  
                    </p>
                <?php
                }    
                ?>
            </div>
        </div>
        <div class="row mapaContato">
            <div class="col-12 mapa">
                <?php if($_SESSION['regiao'] == 'bc'){ ?>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2514.3968853302304!2d-48.64014697011674!3d-26.970250310724023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94d8c9f603000029%3A0x373f40990bc2ad4!2sAv.+do+Estado%2C+1555+-+Centro%2C+Balne%C3%A1rio+Cambori%C3%BA+-+SC!5e0!3m2!1spt-BR!2sbr!4v1515414682409" width="95%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                <?php
                } 
                if($_SESSION['regiao'] == 'bl'){ 
                ?>    
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2115.225932593099!2d-49.063051484546776!3d-26.923424986706134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94df18eb3118bc41%3A0xd5e3b46275ed8eca!2sR.+Sete+de+Setembro%2C+473+-+Centro%2C+Blumenau+-+SC!5e0!3m2!1spt-BR!2sbr!4v1515414780872" width="95%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                <?php
                } 
                if($_SESSION['regiao'] == 'lg'){ 
                ?>     
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.8313857094868!2d-50.30712573044196!3d-27.79849676965969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94e0192af2b9834d%3A0xf89fed5d2ae08eb1!2sAv.+Lu%C3%ADs+de+Cam%C3%B5es%2C+1370+-+Conta+Dinheiro%2C+Lages+-+SC!5e0!3m2!1spt-BR!2sbr!4v1515415451042" width="95%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                <?php
                }    
                ?>
            </div>
        </div>
    </div>
</div> <!-- container --> 