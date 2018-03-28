<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TagCloud extends CI_Model {

	private $tabela = NULL;
	private $campo = NULL;
	private $label = NULL;
	private $preUrl = NULL;
	private $urlSite = NULL;
	private $url = NULL;
	private $count = 'Count';
	private $tabelaRelacionamento = NULL;
	private $query = NULL;
	private $tagsHtml = NULL;
	private $template = '<script src="{CAMINHO}/swfobject.js" type="text/javascript"></script><embed width="{WIDTH}" height="{HEIGHT}" flashvars="tcolor=0x333333&amp;tcolor2=0x333333&amp;hicolor=0x000000&amp;tspeed=100&amp;distr=true&amp;mode=tags&amp;tagcloud={TAGS}" allowscriptaccess="always" quality="high" bgcolor="#ffffff" name="tagcloudflash" id="tagcloudflash" src="{CAMINHO}/tagcloud.swf?r=6366380" type="application/x-shockwave-flash"><script type="text/javascript">var widget_so2685097 = new SWFObject("{CAMINHO}/tagcloud.swf?r=6366380", "tagcloudflash", "160", "160", "9", "#ffffff");widget_so2685097.addParam("allowScriptAccess", "always");widget_so2685097.addVariable("tcolor", "0x333333");widget_so2685097.addVariable("tcolor2", "0x333333");widget_so2685097.addVariable("hicolor", "0x000000");widget_so2685097.addVariable("tspeed", "100");widget_so2685097.addVariable("distr", "true");widget_so2685097.addVariable("mode", "tags");widget_so2685097.addVariable("tagcloud", "{TAGS}");</script>';
	private $tamanhoMinimo = 8;
	private $width = 160;
	private $height = 160;
	private $tags = array();

	public function setTabela( $tabela ) { $this->tabela = $tabela; return $this; }
	public function getTabela() { return $this->tabela; }
	
	public function setCampo( $campo ) { $this->campo = $campo; return $this; }
	public function getCampo() { return $this->campo; }

	public function setLabel( $label ) { $this->label = $label; return $this; }
	public function getLabel() { return $this->label; }

	public function setPreUrl( $preUrl ) { $this->preUrl = $preUrl; return $this; }
	public function getPreUrl() { return $this->preUrl; }

	public function setUrlSite( $urlSite ) { $this->urlSite = $urlSite; return $this; }
	public function getUrlSite() { return $this->urlSite; }

	public function setUrl( $url ) { $this->url = $url; return $this; }
	public function getUrl() { return $this->url; }

	public function setCount( $count ) { $this->count = $count; return $this; }
	public function getCount() { return $this->count; }
	
	public function setTabelaRelacionamento( $tabelaRelacionamento ) { $this->tabelaRelacionamento = $tabelaRelacionamento; return $this; }
	public function getTabelaRelacionamento() { return $this->tabelaRelacionamento; }
	
	public function setTags( $tags ) { $this->tags = $tags; $this->montaTagsHtml(); return $this; }
	public function getTags() { return $this->tags; }
	
	public function setQuery( $query ) { $this->query = $tags; return $this; }
	public function getQuery() { return $this->tags; }
	
	public function setHtml( $html ) { $this->html = $html; return $this; }
	public function getHtml() { return $this->html; }
	
	public function setTamanhoMinimo( $tamanhoMinimo ) { $this->tamanhoMinimo = $tamanhoMinimo; return $this; }
	public function getTamanhoMinimo() { return $this->tamanhoMinimo; }
	
	public function setWidth( $width ) { $this->width = $width; return $this; }
	public function getWidth() { return $this->width; }
	
	public function setHeight( $height ) { $this->height = $height; return $this; }
	public function getHeight() { return $this->height; }

	public function __construct() { parent::__construct(); return $this; }
	
	public function carregar( $tabela, $campo, $label, $url, $tabelaRelacionamento, $urlSite, $preUrl ) {
		$this->setTabela( $tabela );
		$this->setCampo( $campo );
		$this->setLabel( $label );
		$this->setUrl( $url );
		$this->setUrlSite( $urlSite );
		$this->setPreUrl( $preUrl );
		$this->setTabelaRelacionamento( $tabelaRelacionamento );
		
		$queryRelacionamento = ' SELECT COUNT( * ) FROM ' . $this->tabelaRelacionamento . ' r WHERE r.' . $this->campo . ' = t.' . $this->campo ;
		
		$this->query = 'SELECT t.*, (' . $queryRelacionamento . ') AS ' . $this->count . ' FROM ' . $this->tabela . ' t ';
		
		$this->setTags( $this->db->query( $this->query )->result_array() );
		
		return $this;
	}
	
	private function montaTagsHtml() {
		$tagsHtml = '<tags>';
		foreach ( $this->tags as $tag )
			$tagsHtml .= '<a class="tag-link-' . $tag[ $this->campo ] . '" style="font-size: ' . ( ceil( $tag[ $this->count ] / ( $this->tamanhoMinimo / 2 ) ) + $this->tamanhoMinimo ) . 'pt;" title="' . $tag[ $this->count ] . ' usos" href="'. $this->urlSite . $this->preUrl . $tag[ $this->url ] . '">' . $tag[ $this->label ] . '</a>';
		$tagsHtml .= '</tags>';
		
		$this->tagsHtml = $tagsHtml;
	}
	
	public function mostrar() {
		return str_replace( '{TAGS}', urlencode( $this->tagsHtml ), str_replace( '{CAMINHO}', $this->urlSite . 'comum/tagcloud', str_replace( '{WIDTH}', $this->width, str_replace( '{HEIGHT}', $this->height, $this->template ) ) ) );
	}
	
}
