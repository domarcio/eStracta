<?php

declare(strict_types=1);

namespace Nogues\Salary;

use \ArrayIterator;
use \DateTime;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Parse HTML table node.
 */
final class TableParse implements Parse
{
    /**
     * Crawler eases navigation of a list of \DOMNode objects.
     *
     * @var Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    /**
     * All salaries.
     *
     * @var array
     */
    private $salaries = [];

    public function __construct(Crawler $crawler, string $html)
    {
        $this->crawler = $crawler;
        $this->crawler->addHTMLContent($html);

        $this->parse();
    }

    /**
     * Get a collection with Salary object.
     *
     * @return \ArrayIterator
     */
    public function collection(): ArrayIterator
    {
        return new ArrayIterator($this->salaries);
    }

    /**
     * Parse a Table.
     *
     * @return void
     */
    private function parse(): void
    {
        $this->crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
            $value = $tr->filter('td')->each(function ($td, $i) {
                $text = trim($td->text());
                if ($i === 0 && preg_match('/^(\d+){2}\.(\d+){2}\.(\d+){4}$/', $text)) {
                    return new DateTime($text);
                }
                if ($i === 1 && preg_match('/^R\$ (?:[1-9](?:[\d]{0,2}(?:\.[\d]{3})*|[\d]+)|0)(?:,[\d]{0,2})?$/', $text, $matches)) {
                    $text = str_replace('R$ ', '', $matches['0']);
                    $text = (float) str_replace(['.', ','], ['', '.'], $text);
                    return $text;
                }
                return null;
            });

            if (! empty($value['0']) && ! empty($value['1'])) {
                $this->salaries[] = new Salary($value['0'], $value['1']);
            }
        });
    }
}
