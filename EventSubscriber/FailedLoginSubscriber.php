<?php

/*
 * This file is part of the Fail2BanBundle for Kimai.
 * All rights reserved by Kevin Papst (www.keleo.de).
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\Fail2BanBundle\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;

class FailedLoginSubscriber implements EventSubscriberInterface
{
    private $logger;
    private $request;

    public function __construct(LoggerInterface $logger, RequestStack $request)
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationFailureEvent::class => ['onAuthenticationFailure', 100],
        ];
    }

    public function onAuthenticationFailure(AuthenticationFailureEvent $event): void
    {
        if (($request = $this->request->getCurrentRequest()) === null) {
            return;
        }

        $ipAddress = $request->getClientIp();

        $this->logger->error(
            sprintf('%s', $ipAddress)
        );
    }
}
