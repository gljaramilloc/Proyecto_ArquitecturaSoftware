<?php

namespace Tests\Feature;

use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class PaginationTranslationTest extends TestCase
{
    public function test_pagination_summary_is_shown_in_spanish(): void
    {
        app()->setLocale('es');

        $paginationHtml = $this->buildPaginator()->links()->toHtml();

        $this->assertStringContainsString('Mostrando', $paginationHtml);
        $this->assertStringContainsString('resultados', $paginationHtml);
        $this->assertStringNotContainsString('Showing', $paginationHtml);
    }

    public function test_pagination_summary_is_shown_in_english(): void
    {
        app()->setLocale('en');

        $paginationHtml = $this->buildPaginator()->links()->toHtml();

        $this->assertStringContainsString('Showing', $paginationHtml);
        $this->assertStringContainsString('results', $paginationHtml);
    }

    private function buildPaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(range(1, 9), 30, 9, 1);
    }
}
