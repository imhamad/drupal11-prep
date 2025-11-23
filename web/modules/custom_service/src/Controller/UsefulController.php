<?php

namespace Drupal\custom_service\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_service\Service\UsefulDataService;

class UsefulController extends ControllerBase {
    protected $usefulData;

    // Contructor receives the service
    public function __construct(UsefulDataService $usefulData) {
        $this->usefulData = $usefulData;
    }

    //create() pulls service from container
    public static function create(ContainerInterface $container) {
        return new static (
            $container->get('custom_service.useful_data')
        );
    }

    // Route will call this funciton which will return the markup
    public function content() {
        $titles = $this->usefulData->getNodeTitlesByType('article');

        return [
            '#theme' => 'item_list',
            '#items' => $titles,
            '#title' => 'Article Titles from Custom Service',
        ];
    }
}