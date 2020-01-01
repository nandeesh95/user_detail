<?php


namespace Drupal\user_details\Service;

use Drupal\Core\Session\AccountProxy;

final class UserDetailsController
{

  protected $currentUser;

  /**
   * {@inheritdoc}
   * Getting Current user Details using Drupal Service Api
   */
  public function __construct(AccountProxy $current_user)
  {
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
    public function CurrentUserId() {
        return $this->currentUser->id();
    }
}

