<?php
namespace Drupal\book_manager\Controller;


use Drupal\Core\Controller\ControllerBase;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;

class BookListController extends ControllerBase {
        protected $logger;
        protected $database; //new property for database service


public function __construct(LoggerInterface $logger, Connection $database) {
    $this->logger = $logger;
    $this->database = $database;
}


public static function create(ContainerInterface $container) {
    return new static(
    $container->get('logger.factory')->get('book_manager'),
    $container->get('database'),
);
}


public function list() {
    $this->logger->info('Book list visited by user {uid}', ['uid' => $this->currentUser()->id()]);

    $this->database->query('SELECT 1')->execute();

    $message = $this->t('This will list books.');
    $message = $this->t('Database connection established');


return [
'#markup' => $message,
'#cache' => [ 'max-age' => 0 ],
];
}
}