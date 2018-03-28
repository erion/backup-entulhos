<?php
class    paginacao{
	//    CONSTRUCTOR
	function    paginacao($pagina, $numLimite, $numRegistros, $numLinks, $separador){
        //    CONFIG
		$this->    pagina           =    (empty($pagina))? $pagina =1 : $pagina=$pagina;
        $this->    inicio           =    ceil($pagina*$numLimite);
        $this->    numLimite        =    $numLimite;
        $this->    numRegistros     =    $numRegistros;
        $this->    numPaginas       =    ceil($numRegistros/$numLimite);
        $this->    numLinks         =    $numLinks;
        $this->    numLinks2        =    floor($numLinks/2);
        $this->    separador        =    $separador;
    }
    
    //    LINK ANTERIOR
    function    linkAnterior($formato, $inativo="0"){
        if(($this->pagina) > 1)
            $this->mostra_item(ceil($this->pagina-1),$formato);
        elseif(($this->pagina == 0)    &&    $inativo == "1")
            echo $formato;
    }
    
    //    LINK PRÓXIMO
    function    linkProximo($formato, $inativo="0"){
        if(($this->pagina) < $this->numPaginas)
        	$this->mostra_item(ceil($this->pagina+1),$formato);
        elseif(($this->pagina == 0)    &&    $inativo == "1")
            echo $formato;
    }
    
    //    LINKS PAGINAS
    function    links(){
        //    NÚMERO DE LINKS PRONTOS
        $numLinksEsquerda    =    0;
        $numLinksDireita    =    0;
        
        //    LINKS DIMINUINDO
        for($i=$this->pagina-$this->numLinks2; $i<$this->pagina; $i++){
            if($i    >= 1    &&    $numLinksEsquerda <= $this->numLinks2){
                $this->mostra_item($i,$i);
                $numLinksEsquerda++;
            }
        }
        
        //    LINK ATUAL
        echo "<b> ".$this->pagina." </b>";
        
        //    LINKS AUMENTANDO
        for($i=$this->pagina+1; $i<=$this->numPaginas; $i++){
            if($numLinksDireita <= ($this->numLinks-$numLinksEsquerda)-2){
                $this->mostra_item($i,$i);
                $numLinksDireita++;
            }
        }

    }
    
    function mostra_item($i,$conteudo) {
    	$url = explode('&',$_SERVER['REQUEST_URI']);
    	if (strpos($url[count($url)-1],'pag=') === 0)
    		unset($url[count($url)-1]);
    	$url = implode('&',$url);
    	echo " <a href=\"{$url}&pag=$i\">$i </a>";
    }
    
}

?>