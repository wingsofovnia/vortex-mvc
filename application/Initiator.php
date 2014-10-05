<?php
/**
 * Project: VortexMVC
 * Author: Illia Ovchynnikov
 * Date: 14-Sep-14
 */

namespace Application;

use Vortex\Application\Bootstrap;
use Vortex\Utils\Logger;

class Initiator extends Bootstrap {
    public function initBoostrapTest() {
        Logger::debug("Bootstrap Initiator Works Fine!");
    }
} 