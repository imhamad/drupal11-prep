<?php

namespace Drupal\custom_service\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class UsefulDataService {

    protected $entityTypeManager;

    public function __construct(EntityTypeManagerInterface $entityTypeManager) {
        $this->entityTypeManager = $entityTypeManager;
    }

    // Fetch public Node titles from a Content type
    public function getNodeTitlesByType(string $type): array {
        $storage = $this->entityTypeManager->getStorage('node');

        $nids = $storage->getQuery()
            ->condition('status', 1)
            ->condition('type', $type)
            ->accessCheck(TRUE)
            ->execute();

        if (empty($nids)) {
            return [];
        }

        $nodes = $storage->loadMultiple($nids);

        $titles = [];
        foreach ($nodes as $node) {
            $titles[] = $node->label();
        }

        return $titles;
    }
}
