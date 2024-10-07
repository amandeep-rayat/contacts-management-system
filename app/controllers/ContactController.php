<?php
require_once __DIR__ . '/../models/Contact.php';

class ContactController
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact();
    }

    // Add a new contact
    public function addContact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $phone = $_POST['phone'];
            $address = htmlspecialchars($_POST['address']);

            if (!$name || !$email || !preg_match('/^\d{10}$/', $phone)) {
                include __DIR__ . '/../views/error.php';
            } else {
                $this->contactModel->create($name, $email, $phone, $address);
                header('Location: /contacts-management-system/public/');
                exit;
            }
        }
        -include __DIR__ . '/../views/add_contact.php';
    }

    // List contacts with pagination
    public function listContacts($page, $search, $limit)
    {
        $offset = ($page - 1) * $limit;
        if ($search !== '') $search = "%{$search}%";
        $contacts = $this->contactModel->getContacts($limit, $offset, $search);
        $totalContacts = $this->contactModel->countContacts($search);
        $totalPages = ceil($totalContacts / $limit);
        include __DIR__ . '/../views/list_contacts.php';
    }

    // Edit a contact
    public function editContact($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $phone = $_POST['phone'];
            $address = htmlspecialchars($_POST['address']);

            if (!$name || !$email || !preg_match('/^\d{10}$/', $phone)) {
                include __DIR__ . '/../views/error.php';
            } else {
                $this->contactModel->update($id, $name, $email, $phone, $address);
                header('Location: /contacts-management-system/public/');
                exit;
            }
        }
        $contact = $this->contactModel->getContact($id);
        include __DIR__ . '/../views/edit_contact.php';
    }

    // Update a contact
    public function updateContact()
    {
        $id = $_POST['id'];
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $phone = $_POST['phone'];
        $address = htmlspecialchars($_POST['address']);
        print_r($name);
        print_r($email);
        print_r($phone);
        print_r($address);
        if (!$name || !$email || !preg_match('/^\d{10}$/', $phone)) {
            include __DIR__ . '/../views/error.php';
        } else {
            $this->contactModel->update($id, $name, $email, $phone, $address);
            header('Location: /contacts-management-system/public/');
            exit;
        }
    }

    // Delete a contact
    public function deleteContact($id)
    {
        $this->contactModel->delete($id);
        header('Location: /contacts-management-system/public/');
        exit;
    }

    // Search contacts by name or email or phone or address
    public function searchContacts($page, $search, $limit)
    {
        $offset = ($page - 1) * $limit;
        if ($search !== '') $search = "%{$search}%";
        $contacts = $this->contactModel->getContacts($limit, $offset, $search);
        $totalContacts = $this->contactModel->countContacts($search);
        $totalPages = ceil($totalContacts / $limit);
        $contacts['totalPages'] = $totalPages;
        // Return the results as JSON
        header('Content-Type: application/json');
        return json_encode($contacts);
    }

    // About page
    public function about()
    {
        include __DIR__ . '/../views/about.php';
    }

    // Contact page
    public function contact()
    {
        include __DIR__ . '/../views/contact.php';
    }
}
