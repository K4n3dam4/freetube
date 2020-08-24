<?php 

//  ======== LIKE CLASS ========

class Like {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  // add like
  public function addLike($data) {
    $this->db->query(
    'INSERT INTO likes
    (like_vid_id, like_channel_id)
    VALUES (?, ?)');

    $this->db->bind(1, $data['like_vid_id']);
    $this->db->bind(2, $data['like_channel_id']);

    $this->db->execute();
  }

  // delete like
  public function deleteLike($data) {
    $this->db->query(
    'DELETE 
    FROM likes
    WHERE like_vid_id = (?)
    AND like_channel_id = (?)');

    $this->db->bind(1, $data['unlike_vid_id']);
    $this->db->bind(2, $data['unlike_channel_id']);

    $this->db->execute();
  }

  // delete all likes
  public function deleteAllLikes($video) {
    $this->db->query(
      'DELETE 
      FROM likes
      WHERE like_vid_id = (?)');
  
      $this->db->bind(1, $video);
  
      $this->db->execute();
  }

  // check liked
  public function checkLiked($data, $channel_id) {
    $this->db->query(
    'SELECT *
    FROM likes
    WHERE like_vid_id = (?)
    AND like_channel_id = (?)');

    $this->db->bind(1, $data['main_vid']['vid_id']);
    $this->db->bind(2, $channel_id);

    if ($this->db->single() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // ========COUNT
  
  public function countLikes()
  {
    $this->db->query(
    'SELECT * 
    FROM likes');

    $this->db->resultSet();

    return $this->db->rowCount();
  }

}


?>