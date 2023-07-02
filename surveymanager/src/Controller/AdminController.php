<?php

namespace Drupal\surveymanager\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\user\UserAuthInterface;
use Drupal\user\Entity\User;
/**
 * Controller for the example route.
 */
class AdminController extends ControllerBase {

  /**
   * Returns the content for the example route.
   */

  /**
 * Get a list of the user IDs who have a given role.
 *
 * @param string $role
 *   The ID of the user role to find.
 *
 * @return array
 *   An array of user IDs.
 */
  public function getUsersByRole(string $role):array {
    $query = \Drupal::entityQuery('user');
    $query->accessCheck(FALSE);
    $query->condition('status', 1)
      ->condition('roles', $role);
    return $query->execute();
  }

  function read_user_profile_by_uname($uname) {
    $connection = \Drupal::database();
  
    $query = $connection->select('sm_user_profile', 'up')
      ->fields('up')
      ->condition('up.uname', $uname)
      ->execute();
  
    $results = $query->fetchAll();
  
    return $results;
  }
  


  public function list_users()
  {
    
    $result=$this->getUsersByRole("surveyor");
    //print_r($result);
    $header = [
      'ID',
      'Name',
      'Mail',
      'User Name',
    ];
    $rows = [];
    foreach ($result as $record) {
      $user = User::load($record[0]);
      $uname=$user->get('name')->value;
      $profile=$this->read_user_profile_by_uname($uname);
      $mail=$user->getEmail();
      $rows[] = [
        'id' => $record[0],
        'name' => $profile[0]->name,
        'mail' => $mail,
        'uname' => $uname,
      ];
    }
  
    
    $template= [
      '#theme' => 'surveymanager_jobs_table',
      '#header' => $header,
      '#rows' => $rows
      
    ];
    $template['#attached']['library'][] = 'surveymanager/main_library';
    return $template;  
  
  }

  public function list_survey_types()
  {
    
    $result=$this->getUsersByRole("surveyor");
    //print_r($result);
    
    $header = [
      'Survey Name',
      'Survey Code',
    ];
    $rows = [];
    foreach ($result as $record) {
      $user = User::load($record[0]);
      $uname=$user->get('name')->value;
      $profile=$this->read_user_profile_by_uname($uname);
      $mail=$user->getEmail();
      $rows[] = [
        'id' => $record[0],
        'name' => $profile[0]->name,
        'mail' => $mail,
        'uname' => $uname,
      ];
    }
  
    
    $template= [
      '#theme' => 'surveymanager_jobs_table',
      '#header' => $header,
      '#rows' => $rows,
    ];
    $template['#attached']['library'][] = 'surveymanager/main_library';
    return $template;  
  
  }

  public function dashboard()
  {
      return;

  }


}
