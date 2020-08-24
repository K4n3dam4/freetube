<?php
//  ======== CATEGORY CLASS ========

class Category {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  // get all categories
  public function getCategories() {
    // select all from categories
    $this->db->query("SELECT * FROM categories");

    // return result
    return $this->db->resultSet();
  }

  // add new category
  public function addCategory($data) {
    $this->db->query(
    'INSERT
    INTO categories (cat_title)
    VALUE (?)'
    );

    $this->db->bind(1, $data['new_cat']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function editCategory($data) {
    $this->db->query(
    'UPDATE categories
    SET cat_title = (?)
    WHERE cat_id = (?)');

    $this->db->bind(1, $data['edit_cat']);
    $this->db->bind(2, $data['edit_cat_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteCategory($cat_id) {
    $this->db->query(
    'DELETE
    FROM categories
    WHERE cat_id = (?)');

    $this->db->bind(1, $cat_id);

    $this->db->execute();
  }

  // ========COUNT

  public function countCats()
  {
    $this->db->query(
    'SELECT * 
    FROM categories');

    $this->db->resultSet();

    return $this->db->rowCount();
  }
}



?>