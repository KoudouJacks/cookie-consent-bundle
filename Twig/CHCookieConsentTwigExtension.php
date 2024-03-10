<?php

declare(strict_types=1);

/*
 * This file is part of the ConnectHolland CookieConsentBundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\Twig;

use ConnectHolland\CookieConsentBundle\Cookie\CookieChecker;
use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CHCookieConsentTwigExtension extends AbstractExtension
{
    private CookieChecker $cookieChecker;

    public function __construct(CookieChecker $cookieChecker)
    {
        $this->cookieChecker = $cookieChecker;
    }

    /**
     * Register all custom twig functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'chcookieconsent_isCookieConsentSavedByUser',
                [$this, 'isCookieConsentSavedByUser'],
            ),
            new TwigFunction(
                'chcookieconsent_isCategoryAllowedByUser',
                [$this, 'isCategoryAllowedByUser'],
            ),
        ];
    }

    /**
     * Checks if user has sent cookie consent form.
     */
    public function isCookieConsentSavedByUser(): bool
    {
        return $cookieChecker->isCookieConsentSavedByUser();
    }

    /**
     * Checks if user has given permission for cookie category.
     */
    public function isCategoryAllowedByUser(string $category): bool
    {
        return $cookieChecker->isCategoryAllowedByUser($category);
    }
}
