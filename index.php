<?php
    
    include_once('vendor/autoload.php');

    // use Exception;
    use NFePHP\NFe\Make;
    use NFePHP\NFe\Tools;
    use NFePHP\Common\Certificate;
    use NFePHP\NFe\Common\Standardize;
    use NFePHP\NFe\Complements;
    use NFePHP\Gtin\Gtin;

    $nfe = new Make();

    /* INFORMAÇÕES DA NFE */
    $std = new stdClass();
    $std->versao = '4.00'; //versão do layout (string)
    $std->Id = null; //se o Id de 44 digitos não for passado será gerado automaticamente
    $std->pk_nItem = null; //deixe essa variavel sempre como NULL

    $nfe->taginfNFe($std);

    /* IDENTIFICAÇÃO */
    $ide = new stdClass();
    $ide->cUF = 41;
    $ide->cNF = '80070008';
    $ide->natOp = 'VENDA DE MERCADORIAS ORIUNDAS DE TERCEIROS';

    $ide->indPag = 0; //NÃO EXISTE MAIS NA VERSÃO 4.00

    $ide->mod = 55; /* 55 para NF-e ou 65 NFC-e */
    $ide->serie = 1;
    $ide->nNF = 24568;
    $ide->dhEmi = date('Y-m-d\TH:i:dp');
    $ide->dhSaiEnt = date('Y-m-d\TH:i:dp');
    $ide->tpNF = 1; /* Saída */
    $ide->idDest = 1; /* Operação Interna */
    $ide->cMunFG = 4106902;
    $ide->tpImp = 1;
    $ide->tpEmis = 1;
    $ide->cDV = 2;
    $ide->tpAmb = 2; /* 1 Produção - 2 Homologação */
    $ide->finNFe = 1;
    $ide->indFinal = 0;
    $ide->indPres = 0;
    $ide->indIntermed = null;
    $ide->procEmi = 0;
    $ide->verProc = '1.0.1';
    $ide->dhCont = null;
    $ide->xJust = null;
    $nfe->tagide($ide);

    /* EMITENTE */
    $emitente = new stdClass();

    $emitente->xNome = "Junnyldo Costa";
    $emitente->xFant = "aCodeTech";
    $emitente->IE = "123456789"; 
    $emitente->CRT = 1;
    $emitente->CNPJ = "07.924.387/0001-11";
    $nfe->tagemit($emitente);

    /* ENDEREÇO DE EMITENTE */
    $endereco_emitente = new stdClass();
    $endereco_emitente->xLgr = "Rua Mário Colombo";
    $endereco_emitente->nro = "94";
    $endereco_emitente->xCpl = "Casa 2";
    $endereco_emitente->xBairro = "Boqueirão";
    $endereco_emitente->cMun = "4106902";
    $endereco_emitente->xMun = "Curitiba";
    $endereco_emitente->UF = "PR";
    $endereco_emitente->CEP = "81770374";
    $endereco_emitente->cPais = "1052";
    $endereco_emitente->xPais = "Brasil";
    $endereco_emitente->fone = "(41) 9 9847-5685";
    $nfe->tagenderEmit($endereco_emitente);

    /* DESTINATÁRIO */
    $destinatario = new stdClass();
    $destinatario->xNome = "Destinatário Teste";
    $destinatario->indIEDest = 2; //1:Contribuinte ICMS - 2:Isento
    $destinatario->IE = null;    
    $destinatario->CPF = "000.000.000-00";
    $nfe->tagdest($destinatario);

    /* ENDEREÇO DE DESTINATÁRIO */
    $endereco_destinatario = new stdClass();
    $endereco_destinatario->xLgr = "Avenida 2";
    $endereco_destinatario->nro = "80";
    $endereco_destinatario->xCpl = "Sala 21";
    $endereco_destinatario->xBairro = "Centro";
    $endereco_destinatario->cMun = "4106902";
    $endereco_destinatario->xMun = "Curitiba";
    $endereco_destinatario->UF = "PR";
    $endereco_destinatario->CEP = "81770374";
    $endereco_destinatario->cPais = "1052";
    $endereco_destinatario->xPais = "Brasil";
    $endereco_destinatario->fone = "(41) 9 9553-6728";
    $nfe->tagenderEmit($endereco_destinatario);

    /* PRODUTOS */
    $produto = new stdClass();
    $produto->item = 1; //item da NFe
    $produto->cProd = "123";
    $produto->cEAN = "SEM GTIN";
    $produto->xProd = "Gás de Cozinha";
    $produto->NCM = "27111910";
    $produto->CFOP = "5403";
    $produto->uCom = "UNID";
    $produto->qCom = 1;
    $produto->vUnCom = 50;
    $produto->vProd = 90;
    $produto->cEANTrib = "SEM GTIN";
    $produto->uTrib = "UNID";
    $produto->qTrib = 1;
    $produto->vUnTrib = 50;
    $produto->vDesc = 0;
    $produto->indTot = 1;
    $nfe->tagprod($produto);
        
    /* ICMS */
    $icms_produto = new stdClass();
    $icms_produto->item = 1; //item da NFe
    $icms_produto->orig = 0; //Origem nacional
    $icms_produto->CST = "102";
    $nfe->tagICMS($icms_produto);
    
    /* PIS Produto */
    $pis_produto = new stdClass();
    $pis_produto->item = 1; //item da NFe
    $pis_produto->CST = "01";
    $pis_produto->vBC = "0.00";
    $pis_produto->pPIS = "0.00";
    $pis_produto->vPIS = "0.00";
    $nfe->tagPIS($pis_produto);

    /* COFINS Produto */
    $cofins_produto = new stdClass();
    $cofins_produto->item = 1; //item da NFe
    $cofins_produto->CST = "01";
    $cofins_produto->vBC = "0.00";
    $cofins_produto->pCOFINS = "0.00";
    $cofins_produto->vCOFINS = "0.00";
    $nfe->tagCOFINS($cofins_produto);

    /* ICMS Total */
    $icms_total = new stdClass();
    $icms_total->vBC = null;
    $icms_total->vICMS = null;
    $icms_total->vICMSDeson = null;
    $icms_total->vBCST = null;
    $icms_total->vST = null;
    $icms_total->vProd = null;
    $icms_total->vFrete = null;
    $icms_total->vSeg = null;
    $icms_total->vDesc = null;
    $icms_total->vII = null;
    $icms_total->vIPI = null;
    $icms_total->vPIS = null;
    $icms_total->vCOFINS = null;
    $icms_total->vOutro = null;
    $icms_total->vNF = null;
    $icms_total->vIPIDevol = null;
    $icms_total->vTotTrib = null;
    $icms_total->vFCP = null;
    $icms_total->vFCPST = null;
    $icms_total->vFCPSTRet = null;
    $icms_total->vFCPUFDest = null;
    $icms_total->vICMSUFDest = null;
    $icms_total->vICMSUFRemet = null;
    $icms_total->qBCMono = null;
    $icms_total->vICMSMono = null;
    $icms_total->qBCMonoReten = null;
    $icms_total->vICMSMonoReten = null;
    $icms_total->qBCMonoRet = null;
    $icms_total->vICMSMonoRet = null;
    $nfe->tagICMSTot($icms_total);

    /* TRANSPORTE */
    $transporte = new stdClass();
    $transporte->modFrete = 9;
    $nfe->tagtransp($transporte);

    /* PAGAMENTO */
    $troco = new stdClass();
    $troco->vTroco = null; //incluso no layout 4.00, obrigatório informar para NFCe (65)
    $nfe->tagpag($troco);

    $pagamento = new stdClass();
    $pagamento->indPag = '0'; //0: Pagamento à Vista - 1:Pagamento a Prazo
    $pagamento->tPag = '01';
    $pagamento->vPag = 50; //Obs: deve ser informado o valor pago pelo cliente
    $nfe->tagdetPag($pagamento);

    /* RUN */
    $xml = $nfe->getXML();
    header("Content-Type:text/xml");
    echo($xml);
?>