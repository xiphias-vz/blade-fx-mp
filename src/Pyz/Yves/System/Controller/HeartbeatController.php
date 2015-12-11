<?php

namespace Pyz\Yves\System\Controller;

use Pyz\Yves\System\SystemDependencyContainer;
use SprykerEngine\Yves\Application\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method SystemDependencyContainer getDependencyContainer()
 */
class HeartbeatController extends AbstractController
{

    const SYSTEM_UP = 'UP';
    const SYSTEM_DOWN = 'DOWN';
    const SYSTEM_STATUS = 'status';
    const STATUS_REPORT = 'report';

    public function indexAction()
    {
        $heartbeatMonitor = $this->getDependencyContainer()->createHeartbeatMonitor();

        if ($heartbeatMonitor->isSystemAlive()) {
            return $this->jsonResponse(
                [self::SYSTEM_STATUS => self::SYSTEM_UP],
                Response::HTTP_OK
            );
        } else {
            return $this->jsonResponse(
                [self::SYSTEM_STATUS => self::SYSTEM_DOWN, self::STATUS_REPORT => $heartbeatMonitor->getReport()->toArray()],
                Response::HTTP_SERVICE_UNAVAILABLE
            );
        }
    }

}