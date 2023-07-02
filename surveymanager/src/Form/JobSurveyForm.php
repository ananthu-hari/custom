<?php

namespace Drupal\surveymanager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

class JobSurveyForm extends FormBase {

  public function getFormId() {
    return 'job_survey_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['type_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Survey Type ID'),
      '#required' => TRUE,
    ];
  
    $form['job_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Job ID'),
      '#required' => TRUE,
    ];
  
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];
  
    return $form;
  }
  

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Perform any form validation if required.
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save form data to the database.
    $typeid = $form_state->getValue('type_id');
    $jobid = $form_state->getValue('job_id');

    $database = Database::getConnection();
    $database->insert('sm_job_surveys')
      ->fields([
        'type_id' => $typeid,
        'job_id' => $jobid,
      ])
      ->execute();

    // Provide a success message and redirect to a specific page if needed.
    $messenger = \Drupal::messenger();
    $messenger->addMessage($this->t('Job survey saved successfully.'));
  
    //To redirect to another site to display list of job support documents.
    $form_state->setRedirectUrl(Url::fromRoute('surveymanager.list_job_surveys'));
  }

}
?>