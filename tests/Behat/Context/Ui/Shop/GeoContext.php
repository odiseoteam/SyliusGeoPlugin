<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusGeoPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Session\Session;

final class GeoContext implements Context
{
    private Session $session;

    public function __construct(
        Session $session
    ) {
        $this->session = $session;
    }

    /**
     * @When I shop from Australia
     */
    public function iShopFromAustralia()
    {
        $this->session->set('countryCode', 'AU');
    }
}
