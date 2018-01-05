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

                    <form name="sentMessage" id="contactForm" method="post" novalidate="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 controls">
                                        <input type="text" class="form-control" placeholder="Nome" id="name" required="" data-validation-required-message="Por favor digite seu nome." aria-invalid="false">
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 controls">
                                        <input type="email" class="form-control" placeholder="E-mail" id="email" required="" data-validation-required-message="Por favor digite seu e-mail.">
                                        <p class="help-block"></p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 controls">
                                <textarea rows="5" class="form-control" placeholder="Mensagem" id="message" required="" data-validation-required-message="Por favor digite uma mensagem."></textarea>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-yellow btn-lg">Enviar</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div> <!-- contLeft -->

        </div>  <!-- row --> 
    </div>
</div> <!-- container --> 