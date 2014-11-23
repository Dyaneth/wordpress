<?php
/*
Plugin Name: Flux RSS
Description: Un plugin qui affiche un flux RSS
Version: 0.1
Author: Tahina
*/
//----------Affiche le shortcode avec un attribut--------------
//[RSS]
//function afficheFluxRss( $atts ){
//	return "Devrait afficher un flux RSS";
//}
//add_shortcode( 'RSS', 'afficheFluxRss' );

// [RSS url="adresseURL"]

function afficheRss( $atts ) {
    $a = shortcode_atts( array(
        'url' => 'Adresse url du flux RSS',
    ), $atts );

    //    return "{$a['url']}";
    $url = $a['url']; /* insérer ici l'adresse du flux RSS de votre choix */
    $rss = simplexml_load_file($url);
    
    //----------Affiche le contenu de l'objet channel--------------
    //echo "<pre>"; 
    //print_r($rss->channel);
    
    $html = "";
    $html .= '<ul>';
    foreach ($rss->channel->item as $item){
        $datetime = date_create($item->pubDate);
        $date = date_format($datetime, 'd M Y, H\hi');

        $html .= '<li>';
        $html .= '<p><a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')</p>';
        $html .= '<p>'.$item->description.'</p>';
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
add_shortcode( 'RSS', 'afficheRss' );

