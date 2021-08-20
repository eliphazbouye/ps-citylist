<?php

namespace Tntrunkscity\Controller;

use Symfony\Component\HttpFoundation\Response;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class TntrunkscityController extends FrameworkBundleAdminController
{
    public function demoAction()
    {
        return new Response('Hello Tntrunks Yeah');
        // return $this->render('@Modules/your-module/templates/admin/demo.html.twig');
    }
}