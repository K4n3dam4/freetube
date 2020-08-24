<?php 
// ========== COMMENT CLASS =============

class Comment  {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  // ====== ADD COMMENT
  public function addComment($data) {
    $this->db->query(
    'INSERT 
    INTO comments 
    (com_vid_id, com_channel_id, com_content)
    VALUES (?, ?, ?)');

    $this->db->bind(1, $data['com_vid_id']);
    $this->db->bind(2, $data['com_channel_id']);
    $this->db->bind(3, $data['com_content']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // ======= GET COMMENTS
  public function getComments($data) {
    $this->db->query(
    'SELECT *
    FROM comments
    INNER JOIN channels
    ON comments.com_channel_id = channels.channel_id
    WHERE com_vid_id = (?)
    ORDER BY com_date DESC');

    $this->db->bind(1, $data);

    return $this->db->resultSet();
  }

    // get all videos ajax
    public function getCommentsAjax($start, $limit, $id) {
      // join databases and get all videos
      $this->db->query(
      "SELECT *
      FROM comments
      INNER JOIN channels
      ON comments.com_channel_id = channels.channel_id
      WHERE com_vid_id = (?)
      ORDER BY com_date DESC
      LIMIT $start,$limit");

      $this->db->bind(1, $id);
      
      $result = $this->db->resultSet();
  
      if ($this->db->rowCount() > 0) {
        return $result;
      } else {
        return false;
      }
    }

  // Edit COMMENT
  public function editComment($data) {
    $this->db->query(
    'UPDATE comments
    SET com_content = (?)
    WHERE com_id = (?)');

    $this->db->bind(1, $data['com_content']);
    $this->db->bind(2, $data['com_id']);

    $this->db->execute();
  }

  // ======= DELETE COMMENT

  // delete comment
  public function deleteComment($comment_id) {
    $this->db->query(
    'DELETE 
    FROM comments
    WHERE com_id = (?)');

    $this->db->bind(1, $comment_id);

    $this->db->execute();
  }

  // delete all comments
  public function deleteAllComments($video) {
    $this->db->query(
      'DELETE 
      FROM comments
      WHERE com_vid_id = (?)');
  
      $this->db->bind(1, $video);
  
      $this->db->execute();
  }

  // ========COUNT

  public function countComments()
  {
    $this->db->query(
    'SELECT * 
    FROM comments');

    $this->db->resultSet();

    return $this->db->rowCount();
  }
}




?>