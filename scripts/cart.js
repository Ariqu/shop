
$(document).ready(function() {
    function pobierzKoszyk() {
        $.ajax({
            url: './cart/get_cart.php',
            method: 'GET',
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    var produkty = res.produkty;
                    var html = '';
                    for (var i = 0; i < produkty.length; i++) {
                        html += '<li class="border-b border-gray-300 py-2 produkt">' + produkty[i].nazwa + ' - <br><b>' + formatujIlosc(produkty[i].ilosc) + '</b></li>';
                    }
                    html += '<br><br>';
                    html += '<b>Aby przejść do zakupów przejdź do zakładki "Koszyk".</b>';
                    if (produkty.length === 0) {
                        html = '<li class="py-2">Twój koszyk jest pusty</li>';
                    }
                    $('#koszyk-items').html(html);
                } else {
                    alert('Błąd: ' + res.message);
                }
            }
        });
    }

    $('.nav-link').on('mouseenter', function() {
        if ($(this).parent().find('#koszyk').length) {
            pobierzKoszyk();
        }
    });

    function formatujIlosc(ilosc) {
        if (ilosc === 1) {
            return '(' + ilosc + ' produkt' + ')';
        } else if (ilosc > 1 && ilosc < 5) {
            return '(' + ilosc + ' produkty' + ')';
        } else {
            return '(' + ilosc + ' produktów' + ')';
        }
    }
});
