<?php
require_once 'Database.php';

class Contact {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Create contact
    public function create($name, $email, $phone, $address) {
        $stmt = $this->db->prepare('INSERT INTO contacts (name, email, phone, address) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$name, $email, $phone, $address]);
    }

    // Fetch contacts with pagination
    public function getContacts($limit, $offset, $search) {
        if($search !== '') {
            $stmt = $this->db->prepare('SELECT * FROM contacts WHERE name LIKE ? OR email LIKE ? OR phone LIKE ? OR address LIKE ? LIMIT ? OFFSET ?');
            $stmt->bindParam(1, $search, PDO::PARAM_STR);
            $stmt->bindParam(2, $search, PDO::PARAM_STR);
            $stmt->bindParam(3, $search, PDO::PARAM_STR);
            $stmt->bindParam(4, $search, PDO::PARAM_STR);
            $stmt->bindParam(5, $limit, PDO::PARAM_INT);
            $stmt->bindParam(6, $offset, PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare('SELECT * FROM contacts LIMIT ? OFFSET ?');
            $stmt->bindParam(1, $limit, PDO::PARAM_INT);
            $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Search for a contact
    public function search($query) {
        $stmt = $this->db->prepare('SELECT * FROM contacts WHERE name LIKE ? OR email LIKE ? OR phone LIKE ? OR address LIKE ? ');
        $searchQuery = "%{$query}%";
        $stmt->execute([$searchQuery, $searchQuery, $searchQuery, $searchQuery]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Count total contacts for pagination
    public function countContacts($search) {
        if($search !== '') {
            $stmt = $this->db->prepare('SELECT COUNT(*) FROM contacts WHERE name LIKE ? OR email LIKE ? OR phone LIKE ? OR address LIKE ?');
            $stmt->bindParam(1, $search, PDO::PARAM_STR);
            $stmt->bindParam(2, $search, PDO::PARAM_STR);
            $stmt->bindParam(3, $search, PDO::PARAM_STR);
            $stmt->bindParam(4, $search, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            $stmt = $this->db->query('SELECT COUNT(*) FROM contacts');
        }
        return $stmt->fetchColumn();
    }

    // Fetch single contact
    public function getContact($id) {
        $stmt = $this->db->prepare('SELECT * FROM contacts WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update contact
    public function update($id, $name, $email, $phone, $address) {
        $stmt = $this->db->prepare('UPDATE contacts SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?');
        return $stmt->execute([$name, $email, $phone, $address, $id]);
    }

    // Delete contact
    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM contacts WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
