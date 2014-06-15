<?php
/**
 * Project: VortexMVC
 * Author: Ilia Ovchinnikov
 * Date: 19-May-14
 * Time: 20:34
 */

namespace Application\Controllers;
use Vortex\Controller;
use Vortex\View;

class IndexController extends Controller {

    /**
     * @RequestMapping('/customMapping');
     * @Redirect('index', 'index');
     * @Permission('admin','logger');
     */
    public function indexAction() {
        //$this->response->setHeader('Content-Type', 'text/plain');
        $view = new View('index');
        $view->data->firstWords = 'Hello World!';
        $view->render();
    }
}