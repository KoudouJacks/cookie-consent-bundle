<?php

declare(strict_types=1);

/*
 * This file is part of the ConnectHolland CookieConsentBundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\Cookie;

use ConnectHolland\CookieConsentBundle\Enum\CookieNameEnum;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CookieChecker
{
    /**
     * @var Request
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * Check if cookie consent has already been saved.
     */
    public function isCookieConsentSavedByUser(): bool
    {
        $request = $this->requestStack->getCurrentRequest();

        return $request->cookies->has(CookieNameEnum::COOKIE_CONSENT_NAME);
    }

    /**
     * Check if given cookie category is permitted by user.
     */
    public function isCategoryAllowedByUser(string $category): bool
    {
        $request = $this->requestStack->getCurrentRequest();

        return $request->cookies->get(CookieNameEnum::getCookieCategoryName($category)) === 'true';
    }
}
