<?php

function obliczWiek($rokProdukcji)
{
    return (int) date('Y') - $rokProdukcji;
}

function kategoriaWieku($wiek)
{
    if ($wiek <= 3) {
        return 'samochód prawie nowy';
    } elseif ($wiek <= 7) {
        return 'samochód kilkuletni';
    } elseif ($wiek <= 15) {
        return 'samochód używany';
    } else {
        return 'samochód zabytkowy lub starszy';
    }
}

function klasaKategorii($wiek)
{
    if ($wiek <= 3) {
        return 'nowy';
    } elseif ($wiek <= 7) {
        return 'kilkuletni';
    } elseif ($wiek <= 15) {
        return 'uzywany';
    } else {
        return 'zabytkowy';
    }
}

function odmianaLat($wiek)
{
    if ($wiek === 1) {
        return '1 rok';
    }

    $ostatnia = $wiek % 10;
    $ostatnieDwie = $wiek % 100;

    if ($ostatnia >= 2 && $ostatnia <= 4 && !($ostatnieDwie >= 12 && $ostatnieDwie <= 14)) {
        return $wiek . ' lata';
    }

    return $wiek . ' lat';
}

function formatCeny($cena)
{
    return number_format($cena, 0, ',', ' ') . ' zł';
}

function wyszukajSamochody($samochody, $maksymalnaCena)
{
    echo '<h3>Samochody do ' . formatCeny($maksymalnaCena) . '</h3>';
    $znaleziono = 0;

    foreach ($samochody as $auto) {
        if ($auto['cena'] <= $maksymalnaCena) {
            if ($znaleziono === 0) {
                echo '<ul>';
            }
            echo '<li><span>' . $auto['marka'] . ' ' . $auto['model'] . ' (' . $auto['rok'] . ')</span>'
                . '<strong>' . formatCeny($auto['cena']) . '</strong></li>';
            $znaleziono++;
        }
    }

    if ($znaleziono > 0) {
        echo '</ul>';
    } else {
        echo '<p class="brak">Nie znaleziono żadnego samochodu.</p>';
    }
}

function najdrozszySamochod($samochody)
{
    $wynik = $samochody[0];

    foreach ($samochody as $auto) {
        if ($auto['cena'] > $wynik['cena']) {
            $wynik = $auto;
        }
    }

    return $wynik;
}

function najtanszySamochod($samochody)
{
    $wynik = $samochody[0];

    foreach ($samochody as $auto) {
        if ($auto['cena'] < $wynik['cena']) {
            $wynik = $auto;
        }
    }

    return $wynik;
}

function obliczSredniaCene($samochody)
{
    $suma = 0;

    foreach ($samochody as $auto) {
        $suma += $auto['cena'];
    }

    return $suma / count($samochody);
}
