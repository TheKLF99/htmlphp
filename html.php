<?php

class html 
{
    public function tag ( $tag, $attr, $content = '', $close = true, $inline = false )
    {
        return "<$tag ".$this->attr ( $attr ).($inline ? '/>' : ">$content".( $close ? "</$tag>" : "" ) ) ;
    }

    public function nda_file ()
    {
        $nda = 'No Direct Access' ;
        return '<!doctype html>'.$this->tag ( 'html', array ( 'lang' => 'en' ), $this->tag ( 'head', '', $this->tag ( 'title', '', $nda ) ) . $this->tag ( 'body', '', $this->tag ( 'p', '', $nda ) ) ) ;
    }

    public function ctag( $tag ) { return "</$tag>" ; }
    public function cdiv () { return $this->ctag ( 'div' ) ; }

    public function p ( $attr, $content = '', $close = true ) 
    {
        return $this->tag ( 'p', $attr, $content, $close ) ;
    }

    public function b ( $attr, $content = '', $close = true ) 
    {
        $attr = $this->addClass( 'font-weight-bold', $attr ) ;
        return $this->tag ( 'span', $attr, $content, $close ) ;
    }

    public function img ( $img, $alt, $attr = array (), $lazy = true ) 
    {
        if ( !is_array ( $attr ) )
            $attr = array () ;
        $attr['src'] = $img ;
        $attr['alt'] = $alt ;
        if ( $lazy ) 
            $attr['loading'] = 'lazy' ;
        return $this->tag ( 'img', $attr, '', true, true ) ;
    }

    function baseurl()
    {   
        $base_url = (isset($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
        $tmpURL = dirname(__FILE__);        
        $tmpURL = str_replace(chr(92),'/',$tmpURL);
        $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
        $tmpURL = ltrim($tmpURL,'/');
        $tmpURL = rtrim($tmpURL, '/');
        if (strpos($tmpURL,'/'))
        {
            $tmpURL = explode('/',$tmpURL);
            $tmpURL = $tmpURL[0];
        }
        if ($tmpURL !== $_SERVER['HTTP_HOST'])
            $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';
        else
            $base_url .= $tmpURL.'/';
        return $base_url; 
    }
         

    public function picture ( $images, $alt, $attr = array (), $lazy = true, $root = 'images', $img_attr = array () )
    {
        $default = 'png';
        $base = rtrim ( $this->baseurl(), '/' ) ;
        if ( !is_array( $images ) )
            $images = array ( 'orig' => $images ) ;
        if ( isset($images[$default] ) )
            $images['orig'] = $base.$root.'/'.$images[$default].'.'.$default ;
        $original = $images['orig'] ;
        $sources = '' ;
        if ( isset ( $images['webp']) )
            $sources .= $this->tag ( 'source', array ( 'srcset' => $base.$root . '/' . $images['webp'].'.webp', 'type' => 'image/webp', '', true, true ), '', true, true ) ;
        foreach ( $images as $type => $image )
            if ( $type != 'orig' && $type != 'webp' )
                $sources .= $this->tag ( 'source', array ( 'srcset' => $base.$root . '/' . $image.'.'.$type, 'type' => 'image/'.( $type == 'jpg' ? 'jpeg' : $type ) ), '', true, true ) ;
        $sources .= $this->img($original, $alt, $img_attr, $lazy ) ;
        return $this->tag ( 'picture', $attr, $sources ) ;
    }

    public function div ( $attr, $content = '', $close = true )
    {
        return $this->tag('div', $attr, $content, $close ) ;
    }

    public function span ( $attr, $content = '', $close = true )
    {
        return $this->tag('span', $attr, $content, $close ) ;
    }

    public function print_r ( $val )
    {
        echo '<pre>'.print_r ( $val, true ).'</pre>' ;
    }

    public function col ( $attr, $content = '', $size = 12, $breakpoint = '', $close = true ) 
    {
        $breakpoint = ( $breakpoint != '' ? '-' . $breakpoint : '' ) ;
        $size = ( $size == 'col' ? '' : '-'.$size ) ;
        $attr = $this->addClass( "col$breakpoint$size", $attr ) ;
        return $this->div ( $attr, $content, $close ) ;
    }

    private function addClass ( $class, $attr )
    {
        if ( is_array ( $attr ) )
            if ( isset ($attr['class'] ) )
                $attr['class'] .= " $class" ;
            else
                $attr['class'] = $class ;
        elseif ( is_string ( $attr ) ) 
            $attr .= " class=\"$class\"" ;
        else
            $attr = array ( 'class' => $class ) ;
        return $attr ;
    }

    public function row ( $attr, $content = '', $close = true ) 
    {
        $attr = $this->addClass( "row", $attr ) ;
        return $this->div ( $attr, $content, $close ) ;
    }

    private function attr ( $attr )
    {
        $ret = '' ;
        if ( is_array( $attr ) )
            foreach ( $attr as $key => $value ) 
                $ret .= "$key=\"$value\" " ;
        elseif ( is_string( $attr ) ) 
            $ret = $attr ;
        return $ret ;
    }

    public function a ( $link, $attr, $content, $close = true, $home = false )
    {
        if ( $home )
            $link = $this->baseurl () . $link ;
        if ( !is_array($attr) )
            $attr = array () ;
        $attr['href'] = $link ;
        return $this->tag ( 'a', $attr, $content, $close ) ;
    }

    public function h ( $size = 1, $attr = array (), $content = '', $close = true )
    {
        return $this->tag ( 'h'.$size, $attr, $content, $close ) ;
    }

    public function icon ( $icon, $sronly, $hidden = 'false' )
    {
        return $this->tag ( 'i', array ( 'class' => $icon, 'aria-hidden' => $hidden ), $this->tag ( 'span', array ( 'class' => 'sr-only' ), $sronly ) ) ;
    }

    public function ibutton ( $link, $lattr, $icon, $sronly, $hidden = 'false' )
    {
        return $this->a ( $link, $lattr, $this->icon ( $icon, $sronly, $hidden ) ) ;
    }
}
