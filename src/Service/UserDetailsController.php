<?php


namespace Drupal\user_details\Service;

use Drupal\Core\Session\AccountProxy;
use Drupal\user\Entity\User;

final class UserDetailsController
{

  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public function __construct(AccountProxy $current_user)
  {
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('current_user')
    );
  }
}

