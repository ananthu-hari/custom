<?php

namespace Drupal\surveymanager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\UserAuthInterface;
use Drupal\user\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * User Survey Types form.
 */
class UserSurveyTypesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'user_survey_types_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['type_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type ID'),
      '#required' => TRUE,
    ];

    $form['uname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('User Name'),
      '#maxlength' => 64,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // Add any form validation if required.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    // Retrieve the values from the form submission.
    $typeId = $form_state->getValue('type_id');
    $userName = $form_state->getValue('uname');

    // Save the form data to the 'sm_user_survey_types' table in the database.
    $connection = \Drupal::database();
    $query = $connection->insert('sm_user_survey_types')
      ->fields(['type_id', 'uname'])
      ->values([$typeId, $userName])
      ->execute();

    if ($query) {
      // Form submission success message.
      $this->messenger()->addMessage($this->t('Form submitted successfully.'));
    } else {
      // Form submission error message.
      $this->messenger()->addError($this->t('Form submission failed.'));
    }
  }

}
?>