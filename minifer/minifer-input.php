<?php
// Funkcja do kompresji HTML
function minify_html($html) {
    // Usunięcie komentarzy HTML
    $html = preg_replace('/<!--.*?-->/s', '', $html);
    // Usunięcie nadmiarowych białych znaków
    $html = preg_replace('/\s{2,}/', ' ', $html);
    $html = preg_replace('/>\s</', '><', $html);
    return trim($html);
}

// Generowanie HTML
ob_start(); // Rozpocznij buforowanie wyjścia
?>