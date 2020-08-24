<?php
//  ======== CHANNELS ========

class Channel {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  // ===========SIGNUP

  public function add($data) {
    $channel_name = $data['name'];
    $channel_owner = $data['owner'];
    $channel_email = $data['email'];
    $channel_password = $data['pwd'];

    // insert data into channels
    $this->db->query(
    'INSERT 
    INTO channels 
    (channel_name, channel_owner, channel_email, channel_password) 
    VALUES (?, ?, ?, ?)');

    $this->db->bind(1, $channel_name);
    $this->db->bind(2, $channel_owner);
    $this->db->bind(3, $channel_email);
    $this->db->bind(4, $channel_password);

    $this->db->execute();
  }

  // ============LOGIN
  public function login($email, $pwd) {
    $this->db->query(
    'SELECT * 
    FROM channels 
    WHERE channel_email = (?)');


    $this->db->bind(1, $email);

    $result = $this->db->single();
    $pwd_hashed = $result['channel_password'];

    // verify pasword
    if(password_verify($pwd, $pwd_hashed)) {
      return $result;
    } else {
      return false;
    }
  }

  // find channel name
  public function searchName($value) {
    $this->db->query(
    'SELECT * 
    FROM channels 
    WHERE channel_name = (?)');

    $this->db->bind(1, $value);
    $this->db->single();

    // if registered
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // find channel email
  public function searchEmail($value) {
    $this->db->query(
    'SELECT * 
    FROM channels 
    WHERE channel_email = (?)');
    
    $this->db->bind(1, $value);
    $this->db->single();

    // if registered
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // =============UPDATE PROFILE
  public function editProfile($data, bool $passwordChange) {
    if ($passwordChange == false) {
      $this->db->query(
      'UPDATE channels 
      SET channel_name = (?), channel_owner = (?), channel_email = (?) 
      WHERE channel_id = (?)');

      $this->db->bind(1, $data['name']);
      $this->db->bind(2, $data['owner']);
      $this->db->bind(3, $data['email']);
      $this->db->bind(4, $data['channel_id']);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    } else {
      $this->db->query(
      'UPDATE channels 
      SET channel_name = (?), channel_owner = (?), channel_email = (?), channel_password = (?) 
      WHERE channel_id = (?)');
  
        $this->db->bind(1, $data['name']);
        $this->db->bind(2, $data['owner']);
        $this->db->bind(3, $data['email']);
        $this->db->bind(4, $data['pwd']);
        $this->db->bind(5, $data['channel_id']);
        
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        }
        
    }
  }

  public function profileImage($data) {
    $this->db->query(
    'UPDATE channels
    SET channel_img = (?)
    WHERE channel_id = (?)');

    $this->db->bind(1, $data['img']);
    $this->db->bind(2, $data['channel_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function editProfileAdmin($data) {
    $this->db->query(
    'UPDATE channels
    SET channel_is_admin = (?), channel_name = (?), channel_owner = (?), channel_email = (?)
    WHERE channel_id = (?)');

    $this->db->bind(1, $data['is_admin']);
    $this->db->bind(2, $data['channel_name']);
    $this->db->bind(3, $data['channel_owner']);
    $this->db->bind(4, $data['channel_email']);
    $this->db->bind(5, $data['channel_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // ============GET
  public function getAllChannels() {
    $this->db->query(
    'SELECT *
    FROM channels');

    return $this->db->resultSet();
  }

  // find channel by id
  public function searchID($value) {
    $this->db->query(
    'SELECT * 
    FROM channels 
    WHERE channel_id = (?)');

    $this->db->bind(1, $value);
    
    return $this->db->single();
  }

  // ===== DELTE
  public function deleteChannel($channel) {
    $this->db->query(
    'DELETE
    FROM channels
    WHERE channel_id = (?)');

    $this->db->bind(1, $channel);

    $this->db->execute();
  }

  // ========COUNT

  public function countChannels() {
    $this->db->query(
    'SELECT * 
    FROM channels');

    $this->db->resultSet();

    return $this->db->rowCount();
  }

  // ====== MOST LIKED
  public function mostLikedChannels() {
    $this->db->query(
    'SELECT channel_name, channel_img, sum(vid_like_count), sum(vid_com_count) 
    FROM videos 
    INNER JOIN channels 
    ON videos.vid_channel_id = channels.channel_id 
    GROUP BY channel_name, channel_img 
    ORDER BY sum(vid_like_count) ASC
    LIMIT 5');

    $result = $this->db->resultSet();

    if ($this->db->rowCount() > 0) {
      return $result;
    } else {
      return false;
    }
  }
}



?>