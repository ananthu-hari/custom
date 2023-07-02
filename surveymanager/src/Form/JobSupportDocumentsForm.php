<?php

namespace Drupal\surveymanager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

class JobSupportDocumentsForm extends FormBase {

  public function getFormId() {
    return 'job_support_documents_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['type_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type ID'),
      '#required' => TRUE,
    ];

    $form['job_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Job ID'),
      '#required' => TRUE,
    ];

    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Document URL'),
      '#required' => FALSE,
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
    $typeID = $form_state->getValue('type_id');
    $jobID = $form_state->getValue('job_id');
    $url = $form_state->getValue('url');

    $database = Database::getConnection();
    $database->insert('sm_job_support_documents')
      ->fields([
        'type_id' => $typeID,
        'job_id' => $jobID,
        'url' => $url,
      ])
      ->execute();

    // Provide a success message and redirect to a specific page if needed.
    $messenger = \Drupal::messenger();
    $messenger->addMessage($this->t('Job support document saved successfully.'));
  
    //To redirect to another site to display list of job support documents.
    $form_state->setRedirectUrl(Url::fromRoute('surveymanager.list_job_support_document_types'));
  
  }

}
?>