<?php

require_once __DIR__ . '/funkcje.php';

$samochody = [
    ['marka' => 'BMW',        'model' => '320d',    'rok' => 2018, 'cena' => 85000,  'przebieg' => 120000, 'paliwo' => 'diesel',   'moc' => 190],
    ['marka' => 'Audi',       'model' => 'A4',      'rok' => 2020, 'cena' => 110000, 'przebieg' => 80000,  'paliwo' => 'benzyna',  'moc' => 150],
    ['marka' => 'Volkswagen', 'model' => 'Golf',    'rok' => 2015, 'cena' => 38000,  'przebieg' => 175000, 'paliwo' => 'diesel',   'moc' => 105],
    ['marka' => 'Toyota',     'model' => 'Corolla', 'rok' => 2022, 'cena' => 95000,  'przebieg' => 45000,  'paliwo' => 'hybryda',  'moc' => 122],
    ['marka' => 'Skoda',      'model' => 'Octavia', 'rok' => 2019, 'cena' => 62000,  'przebieg' => 98000,  'paliwo' => 'benzyna',  'moc' => 150],
    ['marka' => 'Ford',       'model' => 'Focus',   'rok' => 2012, 'cena' => 21000,  'przebieg' => 210000, 'paliwo' => 'diesel',   'moc' => 115],
    ['marka' => 'Mercedes',   'model' => 'C220d',   'rok' => 2021, 'cena' => 149000, 'przebieg' => 60000,  'paliwo' => 'diesel',   'moc' => 194],
    ['marka' => 'Opel',       'model' => 'Astra',   'rok' => 2016, 'cena' => 33000,  'przebieg' => 150000, 'paliwo' => 'benzyna',  'moc' => 110],
    ['marka' => 'Tesla',      'model' => 'Model 3', 'rok' => 2023, 'cena' => 175000, 'przebieg' => 25000,  'paliwo' => 'elektryk', 'moc' => 283],
    ['marka' => 'Fiat',       'model' => '126p',    'rok' => 1988, 'cena' => 18000,  'przebieg' => 90000,  'paliwo' => 'benzyna',  'moc' => 23],
    ['marka' => 'Renault',    'model' => 'Clio',    'rok' => 2024, 'cena' => 72000,  'przebieg' => 12000,  'paliwo' => 'benzyna',  'moc' => 90],
    ['marka' => 'Hyundai',    'model' => 'Tucson',  'rok' => 2017, 'cena' => 74000,  'przebieg' => 135000, 'paliwo' => 'diesel',   'moc' => 136],
];

usort($samochody, function ($a, $b) {
    return $a['cena'] <=> $b['cena'];
});

$liczbaDiesli = 0;
$liczbaPo2020 = 0;
$liczbaNiskiPrzebieg = 0;

foreach ($samochody as $auto) {
    if ($auto['paliwo'] === 'diesel') {
        $liczbaDiesli++;
    }
    if ($auto['rok'] > 2020) {
        $liczbaPo2020++;
    }
    if ($auto['przebieg'] < 100000) {
        $liczbaNiskiPrzebieg++;
    }
}

$najdrozszy = najdrozszySamochod($samochody);
$najtanszy = najtanszySamochod($samochody);
$sredniaCena = round(obliczSredniaCene($samochody));
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Komis samochodowy</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #f3f4f6;
            color: #1f2937;
            font-family: "Segoe UI", Arial, sans-serif;
            line-height: 1.5;
        }
        header {
            background: #1f2937;
            color: #fff;
            text-align: center;
            padding: 34px 16px;
            border-bottom: 4px solid #f59e0b;
        }
        header h1 { margin: 0; font-size: 30px; letter-spacing: 3px; }
        header p { margin: 6px 0 0; color: #9ca3af; }
        main { max-width: 1100px; margin: 0 auto; padding: 30px 16px 50px; }
        h2 {
            margin: 40px 0 16px;
            font-size: 20px;
            padding-left: 12px;
            border-left: 4px solid #f59e0b;
        }
        .oferty {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 18px;
        }
        .auto {
            background: #fff;
            border-radius: 10px;
            padding: 18px 20px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }
        .auto h3 { margin: 0; font-size: 18px; }
        .auto .cena { margin: 2px 0 12px; font-size: 20px; font-weight: 700; color: #d97706; }
        .auto dl { margin: 0; }
        .auto .wiersz {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }
        .auto dt { color: #6b7280; }
        .auto dd { margin: 0; font-weight: 600; }
        .kategoria {
            display: inline-block;
            margin-top: 12px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .nowy { background: #d1fae5; color: #065f46; }
        .kilkuletni { background: #dbeafe; color: #1e40af; }
        .uzywany { background: #fef3c7; color: #92400e; }
        .zabytkowy { background: #e5e7eb; color: #374151; }
        .wyszukiwarka {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 18px;
        }
        .box {
            background: #fff;
            border-radius: 10px;
            padding: 18px 20px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }
        .box h3 { margin: 0 0 10px; font-size: 16px; }
        .box ul { list-style: none; margin: 0; padding: 0; }
        .box li {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }
        .box .brak { margin: 0; color: #b91c1c; font-size: 14px; }
        .statystyki {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 18px;
        }
        .kafel {
            background: #fff;
            border-radius: 10px;
            padding: 16px 18px;
            border-top: 3px solid #f59e0b;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }
        .kafel span { display: block; font-size: 13px; color: #6b7280; }
        .kafel strong { font-size: 20px; }
        .kafel small { display: block; color: #6b7280; }
    </style>
</head>
<body>
    <header>
        <h1>KOMIS SAMOCHODOWY</h1>
        <p>Oferty posortowane od najtańszej do najdroższej</p>
    </header>

    <main>
        <h2>Oferty</h2>
        <div class="oferty">
            <?php foreach ($samochody as $auto): ?>
                <?php $wiek = obliczWiek($auto['rok']); ?>
                <div class="auto">
                    <h3><?= $auto['marka'] ?> <?= $auto['model'] ?></h3>
                    <div class="cena"><?= formatCeny($auto['cena']) ?></div>
                    <dl>
                        <div class="wiersz"><dt>Rok produkcji:</dt><dd><?= $auto['rok'] ?></dd></div>
                        <div class="wiersz"><dt>Cena:</dt><dd><?= formatCeny($auto['cena']) ?></dd></div>
                        <div class="wiersz"><dt>Przebieg:</dt><dd><?= number_format($auto['przebieg'], 0, ',', ' ') ?> km</dd></div>
                        <div class="wiersz"><dt>Paliwo:</dt><dd><?= $auto['paliwo'] ?></dd></div>
                        <div class="wiersz"><dt>Moc:</dt><dd><?= $auto['moc'] ?> KM</dd></div>
                        <div class="wiersz"><dt>Wiek:</dt><dd><?= odmianaLat($wiek) ?></dd></div>
                    </dl>
                    <span class="kategoria <?= klasaKategorii($wiek) ?>">
                        Kategoria: <?= kategoriaWieku($wiek) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>Wyszukiwarka ofert</h2>
        <div class="wyszukiwarka">
            <div class="box"><?php wyszukajSamochody($samochody, 50000); ?></div>
            <div class="box"><?php wyszukajSamochody($samochody, 10000); ?></div>
        </div>

        <h2>Statystyki</h2>
        <div class="statystyki">
            <div class="kafel"><span>Liczba samochodów</span><strong><?= count($samochody) ?></strong></div>
            <div class="kafel"><span>Średnia cena</span><strong><?= formatCeny($sredniaCena) ?></strong></div>
            <div class="kafel">
                <span>Najdroższy</span>
                <strong><?= $najdrozszy['marka'] ?> <?= $najdrozszy['model'] ?></strong>
                <small><?= formatCeny($najdrozszy['cena']) ?></small>
            </div>
            <div class="kafel">
                <span>Najtańszy</span>
                <strong><?= $najtanszy['marka'] ?> <?= $najtanszy['model'] ?></strong>
                <small><?= formatCeny($najtanszy['cena']) ?></small>
            </div>
            <div class="kafel"><span>Samochody diesel</span><strong><?= $liczbaDiesli ?></strong></div>
            <div class="kafel"><span>Samochody po 2020 roku</span><strong><?= $liczbaPo2020 ?></strong></div>
            <div class="kafel"><span>Przebieg poniżej 100000 km</span><strong><?= $liczbaNiskiPrzebieg ?></strong></div>
        </div>
    </main>
</body>
</html>
