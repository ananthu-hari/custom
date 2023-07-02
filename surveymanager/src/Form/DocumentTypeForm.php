<?php

namespace Drupal\surveymanager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

class DocumentTypeForm extends FormBase {

  public function getFormId() {
    return 'document_type_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['type_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Document Type Name'),
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
    $typeName = $form_state->getValue('type_name');

    $database = Database::getConnection();
    $database->insert('sm_support_document_types')
      ->fields([
        'type_name' => $typeName,
      ])
      ->execute();

    // Display a success message.
    \Drupal::messenger()->addMessage('document type saved successfully', 'status');
    $form_state->setRedirect('surveymanager.list_document_types');
  }

}
?>