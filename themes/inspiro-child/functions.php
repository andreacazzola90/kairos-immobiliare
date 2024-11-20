<?php

function my_theme_enqueue_styles() {
    $parent_style = 'inspiro'; // Sostituisci con il nome corretto del tuo tema padre

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), wp_get_theme()->get('Version'));
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


function mostra_campi_acf($atts) {
    // Estrai gli attributi
    $atts = shortcode_atts(array(
        'campo1' => 'nome_del_campo_1',
        'campo2' => 'nome_del_campo_2',
        'campo3' => 'nome_del_campo_3',
    ), $atts);

    // Inizializza la variabile di output
    $output = '';

    // Recupera i valori dei campi
    $campo1 = get_field($atts['campo1']);
    $campo2 = get_field($atts['campo2']);
    $campo3 = get_field($atts['campo3']);

    // Costruisci l'output
 
        // $output .= '<p>' .$atts['campo1'] .': '.  esc_html(get_field(atts[0])) . '</p>';
 
	if ($campo1) {
        $output .= '<p>' .$atts['campo1'] .': '.  esc_html($campo1) . '</p>';
    }
    if ($campo2) {
        $output .= '<p>'.$atts['campo2'] .': '. esc_html($campo2) . '</p>';
    }
    if ($campo3) {
        $output .= '<p>'.$atts['campo3'] .': '. esc_html($campo3) . '</p>';
    }

    return $output;
}
add_shortcode('mostra_acf', 'mostra_campi_acf');

?>