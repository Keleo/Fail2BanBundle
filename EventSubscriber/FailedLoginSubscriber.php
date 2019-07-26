<?php

/*
 * This file is part of the Kimai Fail2BanBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\Fail2BanBundle\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;

class FailedLoginSubscriber implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var RequestStack
     */
    private $request;

    public function __construct(LoggerInterface $logger, RequestStack $request)
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationEvents::AUTHENTICATION_FAILURE => ['onAuthenticationFailure', 100],
        ];
    }

    public function onAuthenticationFailure(AuthenticationFailureEvent $event)
    {
        $ipAddress = $this->request->getCurrentRequest()->getClientIp();

        $this->logger->error(
            sprintf('%s', $ipAddress)
        );
    }
}
