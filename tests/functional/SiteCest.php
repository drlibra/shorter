<?php

namespace app\tests\functional;

class SiteCest
{
    /**
     * Tests creating short URL through main page.
     *
     * @param \FunctionalTester $I Tester
     */
    public function createShortUrl(\FunctionalTester $I): void
    {
        $I->amOnPage('/');
        $I->submitForm('form', [
            'long_url' => 'http://www.ya.ru',
        ]);
        $I->see('Short url');
    }

    /**
     * Tests showing validation errors.
     *
     * @param \FunctionalTester $I Tester
     */
    public function showValidationErrors(\FunctionalTester $I): void
    {
        $I->amOnPage('/');
        $I->submitForm('form', []);
        $I->see('Long Url cannot be blank.');
    }
}
