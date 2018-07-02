<?php

namespace App\Controllers;

class TestController extends Controller
{
    public function general($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/test/*' route", array("key"=>"value", 'key2'=>'value2'));

        // Read app settings
        $settings = $this->container->get('settings')['site'];
        // Read $_GET data
        $get = $request->getQueryParams();
        // Read $_POST data
        $post = $request->getParsedBody();

        // Write to page via response
        //return $response->write("Hello " . $args['name']);

        $data = array();
        if (isset($args['name']) && $args['name']) {
            $data['name'] = $args['name'];
        }

        // Write to page via twig
        return $this->view->render($response, 'test.html', $data);
    }
}