$(document).ready(function()
{
    $('input#numFotos').val(Contador . init(1, 1, 20))
        .keyup(function()
        {
            if(window.mg_dalay) {
                window.clearTimeout(window.mg_dalay);
            }
    
            window.mg_dalay = window.setTimeout(function(){
                var num = $('input#numFotos').val();
                if (num >= Contador . valorMinimo && num <= Contador . valorMaximo) {
                    Contador . contador = num;
                } else {
                    $('input#numFotos').val(Contador . contador);
                }
                adicionarInputs($('div#groupDivs').get(0), Contador . contador, 'Resposta ', 'text', 'resposta[]');
            }, 700);
        });
    adicionarInputs($('div#groupDivs').get(0), Contador . contador, 'Resposta ', 'text', 'resposta[]');

    $('#maisFotos').click(function()
    {
		var num = Contador . aumenta();
        $('input#numFotos').val(num);
        adicionarInputs($('div#groupDivs').get(0), num, 'Resposta ', 'text', 'resposta[]');
	});

    $('#menosFotos').click(function()
    {
		var num = Contador . diminui();
        $('input#numFotos').val(num);
        adicionarInputs($('div#groupDivs').get(0), num, 'Resposta ', 'text', 'resposta[]');
	});

});

/**
 * adicionarInputs()
 * 
 * Função para adicionar linhas em 
 * uma tabela especificada no parâmetro 
 * tabela cada uma com duas colunas.
 * Uma contendo o label passado no 
 * parâmetro label e outra um input 
 * do tipo passado no parâmetro type 
 * com o nome passado no parâmetro name.
 *
 * É possível adicionar eoutro input para legenda passando o parâmetro legenda:
 * legenda == 1 =>	Legenda ao lado na mesma linha
 * legenda == 2 =>	Legenda em nova linha
 * 
 * Dependências:
 * 1 - limparLinhas(tabela)
 * 
 */
function adicionarInputs(objParent, numeroDeElementos, textoLabelLegenda, typeLegenda, nameLegenda)
{	
	textoLabelLegenda = typeof(textoLabelLegenda) != 'undefined' ? textoLabelLegenda : 'Default Value';
	typeLegenda = typeof(typeLegenda) != 'undefined' ? typeLegenda : 'text';
	nameLegenda = typeof(nameLegenda) != 'undefined' ? nameLegenda : 'Default Value';
    
    limparObj(objParent);
    
    /** Propriedades do input 
    size = 35;
    **/
    sizeLegenda = 50; 
    classInput = '';
    classLegenda = '';
    
    /** Propriedades das células 
    cellLeftAlign = 'right';
    cellLeftWidth = '100'; **/
    classLabel = '';
    
    /*cellRightAlign = 'left';
    cellRightWidth = '100';*/ 
    
//    var numLinhas = tabela . rows . length;
//    var contador = numLinhas / 2;
    var contador = 0;

    for (var n = 1; n <= numeroDeElementos; n++) {
        contador++;

//        var linha = tabela . insertRow(-1);
//        var newcell = linha . insertCell(-1);
        var objLinha = document . createElement('DIV');
        var objLabel = document . createElement('LABEL');
        if (classLabel) {
            objLabel . style . className = classLabel;
        }
        
        var txt = document . createTextNode(textoLabelLegenda + ' ' + contador);
        objLabel . appendChild(txt);
        objLabel . setAttribute('style', 'margin-right:36px');
        objLinha . appendChild(objLabel);

        var objInput2 = document . createElement('INPUT');
        objInput2 . setAttribute('type', typeLegenda);
        objInput2 . setAttribute('name', nameLegenda);
        objInput2 . setAttribute('id', nameLegenda);
        objInput2 . setAttribute('size', sizeLegenda);
        objInput2 . setAttribute('style', 'margin-bottom:4px; margin-top:4px; width:500px;');
        if (classInput) {
            objInput2 . style . className = classInput;
        }

        objLinha . appendChild(objInput2);

        objParent . appendChild(objLinha);
	}
}

/**
 * limparObj()
 * 
 * Função para remover todos os  
 * objetos filho do objeto especificado no
 * parâmetro obj.
 * Função auxiliar a adicionarInputs().
 * 
 */
function limparObj(obj)
{
    obj = typeof(obj) != 'undefined' && obj != '' ? obj : document . createElement('DIV');

    while (obj . lastChild) {
        obj . removeChild(obj . lastChild);
    }
}

/**
 * Contador()
 * 
 * Retorna o número do contador.
 * 
 * @param integer valorInicial			Valor inicial.
 * @param integer valorMinimo			Valor minimo.
 * @param integer valorMaximo			Valor máximo.
 * @return
 */
Contador = 
{
    contador : 0
    , valorMinimo : 0
    , valorMaximo : 999
    
	, init : function (valorInicial, valorMinimo, valorMaximo)
    {
        this . contador = typeof(valorInicial) != 'undefined' ? valorInicial : this . contador;
        this . valorMinimo = typeof(valorMinimo) != 'undefined' ? valorMinimo : this . valorMinimo;
        this . valorMaximo = typeof(valorMaximo) != 'undefined' ? valorMaximo : this . valorMaximo;

        return this . atualiza();
    }

    , atualiza : function ()
    {
        return this . contador;
    }

    , aumenta : function ()
    {
        if (!this . testeValorMaximo()) {
            this . contador++;
        }
        return this . atualiza();
    }

    , diminui : function ()
    {
        if (!this . testeValorMinimo()) {
            this . contador--;
        }
        return this . atualiza();
    }

    , testeValorMinimo : function ()
    {
        if (this . contador <= this . valorMinimo) {
            return true;
        } else {
            return false;
        }
    }

    , testeValorMaximo : function ()
    {
        if (this . contador >= this . valorMaximo) {
            return true;
        } else {
            return false;
        }
    }
}


$(document).ready(function()
{
    /*
    $('div.ctnrContArq').ContArq({
        cont_ini: 1
        ,cont_min: 1
        ,cont_max: 10
        ,callback: function(cont)
        {
            adicionarInputs($('div.ctnrArqs').get(0), cont, 'Resposta', 'text', 'resposta');
            var ctnrArqs = $('div.ctnrArqs')
            var qtdDivs = ctnrArqs.children('div').size();

            if (ctnrArqs.children('div').size() <= 0) {
                for (var i = 1; i <= cont; i++) {
                    ctnrArqs.append('<div>'+
                                        '<div>'+
                                            '<label>Resposta<span> '+i+'</span></label><input type="text" name="resposta[]" id="resposta'+i+'" title="Resposta '+i+'">'+
                                        '</div>'+
                                    '</td></div>').children('div:last').hide().fadeIn('slow');

                    //objValidador . adicionar('input#foto'+i+'');
                    //objValidador . adicionar('input#legenda'+i+'');
                }
            }
            if (ctnrArqs.children('div').size() > 0) {
                if (qtdDivs > cont) {
                    for (var i = ctnrArqs.children('div').size(); i > cont; i--) {
                        objValidador . remover('input#resposta'+(i)+'');

                        ctnrArqs.children('div').eq(i-1).fadeOut('slow', function() { $(this).remove(); });
                    }
                } else {
                    for (var i = ctnrArqs.children('div').size(); i < cont; i++) {
                        ctnrArqs.append('<div>'+
                                            '<div>'+
                                                '<label>Resposta<span> '+(i+1)+'</span></label><input type="text" name="resposta[]" id="resposta'+(i+1)+'" title="Resposta '+(i+1)+'">'+
                                            '</div>'+                                          
                                        '</td></div>').children('div:last').hide().fadeIn('slow');

                        objValidador . adicionar('input#resposta'+(i+1)+'');
                    }
                }
            }
        }
    }).find('div.ctnrControls, label span').hide(); //esconde pq é só uma foto*/
});