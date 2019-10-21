<?php

require_once __DIR__ . '/vendor/autoload.php';

$client   = new GuzzleHttp\Client();
$response = $client->request('GET', 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm');
$html     = $response->getBody();

$tableParse = new Nogues\Salary\TableParse(new Symfony\Component\DomCrawler\Crawler(), utf8_encode($html->getContents()));
$salaries   = $tableParse->collection();

echo PHP_EOL;
foreach ($salaries as $salary) {
    printf(
        'Effective date: %s | Salary: R$ %.02f %s',
        $salary->getEffectiveDate()->format('d/m/Y'),
        $salary->getSalary(),
        PHP_EOL
    );
}
echo PHP_EOL;
