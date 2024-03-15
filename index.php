<?php

use NFePHP\NFe\Make;
    
    include_once('vendor/autoload.php');
    $nfe = new Make();
    
    $ide = new stdClass();
    $ide->cUF = 41;
    $ide->cNF = '80070008';
    $ide->natOp = 'VENDA DE MERCADORIAS ORIUNDAS DE TERCEIROS';

    $ide->indPag = 0; //NÃO EXISTE MAIS NA VERSÃO 4.00

    $ide->mod = 55; /* 55 para NF-e ou 65 NFC-e */
    $ide->serie = 1;
    $ide->nNF = 24568;
    $ide->dhEmi = date('Y-m-dTH:i:dp');
    $ide->dhSaiEnt = date('Y-m-dTH:i:dp');
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

?>